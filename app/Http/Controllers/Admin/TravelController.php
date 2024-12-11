<?php

namespace App\Http\Controllers\Admin;

use App\Models\Travel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTravelRequest;
use App\Http\Requests\UpdateTravelRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Step;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // variabile che salva l'id dell'utente che si e loggato
        $id = Auth::id();

        // variabile con tutti i viaggi nel db in ordine discendente in base chi si e loggato
        $travels = Travel::where('user_id', $id)->orderByDesc('id')->paginate(5);


        // rispedisce alla pagina inde di travel con tutti i viaggi
        return view('admin.travels.index', compact('travels', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // rispedisce alla pagina creazione di travel
        return view('admin.travels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTravelRequest $request)
    {
        // variabile con i dati validati
        $val_data = $request->validated();

        // se nella richiesta ce image
        if ($request->has('image')) {

            // viene inserita l'immagine nello storage
            $val_data['image'] = Storage::disk('public')->put('uploads/images', $val_data['image']);
        };

        // variabile che fa checker o salva il numero di travel con lo stesso nome
        $slug_checker = Travel::where('name', $val_data['name'])->count();

        // se esiste lo slug
        if ($slug_checker) {

            // variabile che salva lo slug
            $slug = Str::slug($val_data['name'], '-') . '-' . $slug_checker + 1;
        } else {

            // variabile che salva lo slug
            $slug = Str::slug($val_data['name'], '-');
        }

        //salva lo slug nella nella key slug 
        $val_data['slug'] = $slug;

        // salvo l'user_id
        $val_data['user_id'] = Auth::id();

        // prendo le due date e le saparo ma nello stesso array
        $dates = explode(" to ", $val_data['date_range']);

        // setto la data di inizio per il database
        $begin = explode('/', $dates[0]);
        $begin = $begin[2] . '-' . $begin[1] . '-' . $begin[0];
        $val_data['date_start'] = $begin;

        // setto la data di fine per il database
        $end = explode('/', $dates[1]);
        $end = $end[2] . '-' . $end[1] . '-' . $end[0];
        $val_data['date_finish'] = $end;

        // crea un nuovo viaggio e lo inserisce nel db
        $travel = Travel::create($val_data);

        // renderizzo alla pagina index del viaggio con un messaggio per la session
        return to_route('admin.travels.index')->with('message', "Hai creato il viaggio: $travel->name");
    }

    /**
     * Display the specified resource.
     */
    public function show(Travel $travel)
    {
        // se l'id dell'utente e uguale a quello del viaggio
        if (Gate::allows('travel_checker', $travel)) {



            // creo una varibile con un array vuoto
            $dateArray = [];

            // salvo nella variabile la data d'inizio del viaggio trasformato in datetime 
            $begin = new DateTime($travel->date_start);

            // formato la data come quella italiana
            $travel->date_start =  $begin->format('d/m/Y');



            // se la data viene passata
            if ($_GET) {


                // salvo nella variabile il dato passato
                $varaiable = key($_GET);
            } else {
                // salvo nella variabile la data formattata


                $varaiable = $begin->format('Y-m-d');
            }

            // salvo nella variabile la dat di fine del viaggio trasformato in dateTime
            $end   = new DateTime($travel->date_finish);

            // formato la data come quella italiana
            $travel->date_finish = $end->format('d/m/Y');

            // itero per la durata del viaggio
            for ($i = $begin; $i <= $end; $i->modify('+1 day')) {

                // creo una variabile con un array vuota
                $array = [];
                if ($i->format('Y-m-d') == $varaiable) {


                    // setto l'array
                    $array = [
                        [
                            "value" => $i->format('Y-m-d'),
                            "format" => $i->format('d-m'),
                            "visible" => 'yes'
                        ]
                    ];
                } else {

                    // setto l'array
                    $array = [
                        [
                            "value" => $i->format('Y-m-d'),
                            "format" => $i->format('d-m'),
                            "visible" => 'no'

                        ]
                    ];
                }


                // pusho l'array in dateArray
                array_push($dateArray, $array);
            }

            // salvo nella variabile gl'itinerari che hanno la data ugule a varaible e con l'id del viaggio selezionato
            $steps = Step::where('date', $varaiable)->where('travel_id', $travel->id)->orderBy('time_start', 'asc')->get();


            $dd = Http::get('https://api.tomtom.com/style/1/sprite/20.3.2-3/sprite@2x.png?key=k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd&traffic_incidents=incidents_s1&traffic_flow=flow_relative0-dark');
            // dd($response);

            // creo un istanza per la classe client
            $client = new Client();

            // inizializzo la variabile che conterrano le longitudini
            $arrayLong = '';
            // inizializzo la variabile che conterrano le latitudini
            $arrayLat = '';
            //inizializzo la varibile che conterra le date
            $timeArray = '';

            // ciclo per gli itinerari
            foreach ($steps as $step) {

                // prendo l'indirizzo
                $address = urlencode($step->location);

                // faccio la chiamata pi a tomtom per darmi le latitudine e longitudine
                $response = $client->get('https://api.tomtom.com/search/2/geocode/%27.' . $address . '.%27.json', [
                    'query' => [
                        'key' => 'k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd',
                        'limit' => 1
                    ]
                ]);

                // stampera un messaggio in caso di errore 
                error_log(print_r($response, true));

                // decodifica la risposta json in un array
                $data = json_decode($response->getBody(), true);

                // prendo la latitudine
                $latitude = $data['results'][0]['position']['lat'];

                // se la varibile e vuota
                if ($arrayLat === '') {

                    $arrayLat = $latitude;
                } else { //altrimenti
                    $arrayLat .= ',' . $latitude;
                }

                // prendo la longitudine
                $longitude = $data['results'][0]['position']['lon'];

                // se la varibile e vuota
                if ($arrayLong === '') {
                    $arrayLong = $longitude;
                } else { //altrimenti
                    $arrayLong .= ',' . $longitude;
                }

                // se la variabile e vuota
                if ($timeArray === '') {
                    $timeArray = $step->time_start;
                } else { //altrimenti
                    $timeArray .= ',' . $step->time_start;
                }
            }


            //salvo in una variabile il dato trasformato in datTime
            $format = new DateTime($varaiable);

            // salvo la data formata
            $format = $format->format('d-m');

            // creo un array inserendo i dati
            $dateActive = [
                'value' => $varaiable,
                'format' => $format
            ];

            // renderizzo alla pagina show del viaggio passando il viaggio, le date del viaggio, l'itineraio della data selezionat e la data selezionata
            return view('admin.travels.show', compact('travel', 'dateArray', 'steps', 'dateActive', 'arrayLong', 'arrayLat', 'timeArray'));
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travel $travel)
    {
        // se l'id dell'utente e uguale a quello del viaggio
        if (Gate::allows('travel_checker', $travel)) {

            // renderizzo alla pagina di modifica del viaggio passando il viaggio
            return view('admin.travels.edit', compact('travel'));
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTravelRequest $request, Travel $travel)
    {
        // se l'id dell'utente e uguale a quello del viaggio
        if (Gate::allows('travel_checker', $travel)) {
            // variabile con i dati validati
            $val_data = $request->validated();

            // se ce image
            if ($request->has('image')) {

                // se esiste l'immagine di travel
                if ($travel->image) {

                    // l'immagine viene cancellata da storage
                    Storage::disk('public')->delete($travel->image);
                }
                // imagine viene inserita in storage
                $val_data['image'] = Storage::disk('public')->put('uploads/images', $val_data['image']);
            }

            // variabile che fa checker o salva il numero di travel con lo stesso nome
            $slug_checker = Travel::where('name', $val_data['name'])->count();

            // se esiste lo slug
            if ($slug_checker) {

                // variabile che salva lo slug
                $slug = Str::slug($val_data['name'], '-') . '-' . $slug_checker + 1;
            } else {

                // variabile che salva lo slug
                $slug = Str::slug($val_data['name'], '-');
            }

            // prendo le due date e le saparo ma nello stesso array
            $dates = explode(" to ", $val_data['date_range']);

            // setto la data di inizio per il database
            $begin = explode('/', $dates[0]);
            $begin = $begin[2] . '-' . $begin[1] . '-' . $begin[0];
            $val_data['date_start'] = $begin;

            // setto la data di fine per il database
            $end = explode('/', $dates[1]);
            $end = $end[2] . '-' . $end[1] . '-' . $end[0];
            $val_data['date_finish'] = $end;

            // modifica travel con i nuovi dati
            $travel->update($val_data);

            // renderizzo alla pagina show del viaggio passando un messaggio di sesion
            return to_route('admin.travels.index')->with('message', "Hai modificato il viaggio: $travel->name");
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Travel $travel)
    {
        // se l'id dell'utente e uguale a quello del viaggio
        if (Gate::allows('travel_checker', $travel)) {

            // se esiste l'immagine di travel
            if ($travel->image) {

                // l'immagine viene cancellata da storage
                Storage::disk('public')->delete($travel->image);
            }

            // variabile che salva il nome di travel+
            $name = $travel->name;

            // cancello travel
            $travel->delete();

            // renderizzo alla pagina precedente con un messaggio per la session
            return redirect()->back()->with('message', "Hai cancellato il viaggio: $name");
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }
}
