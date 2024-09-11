<?php

namespace App\Http\Controllers\Admin;

use App\Models\Step;
use App\Http\Requests\StoreStepRequest;
use App\Http\Requests\UpdateStepRequest;
use App\Http\Controllers\Controller;
use App\Models\Travel;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;


class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // salvo in una variabilel'id dell'utente attualmente collegato
        $id = Auth::id();

        //salva in una variabile i viaggi in base all'id dell'utente attualmente collegato
        $travels = Travel::where('user_id', $id)->get();

        // creo una variabile con un array vuoto
        $range = [];

        // itero i viaggi
        foreach ($travels as $travel) {

            // pusho tutti gli id dei viaggi in range
            array_push($range, $travel->id);
        }

        // salvo in una variabile tutti gli itinerari che hanno gli id dei viaggi, vengo ordinati in ordine decrescente
        $steps = Step::whereIn('travel_id', $range)->orderByDesc('id')->paginate(6);

        // renderizza alla pagina index degl'itenerari e passa gl'itenerari
        return view('admin.steps.index', compact('steps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //salvo in una variabile l'id del viaggio
        $travel_id = array_key_first($_GET);

        // salvo in una variabile la data se passo dallo show del viaggio
        $date = array_key_last($_GET);
        $date = explode('-', $date);
        $string = $date[2] . '/' . $date[1] . '/' . $date[0];
        $date = $string;

        // inizio la session
        session_start();

        // se la data e salvata
        if ($date !== null) {
            // dd($_GET, $travel_id, $date);


            // salvo l'id del viaggio
            $_SESSION['travel-id'] = $travel_id;

            // salvo la risposta se devo riotornare allo show del viaggio
            $_SESSION['travel-page'] = 'si';
        } else {
            // salvo la risposta se devo riotornare allo show del viaggio
            $_SESSION['travel-page'] = 'no';
        }



        // salvo in una variabile l'id dell'utente attualmente collegato
        $id = Auth::id();

        // salvo in una varibile tutti i viaggi dell'utente attaulmente collegato
        $travels = Travel::where('user_id', $id)->get();

        // renderizzo alla pagina di creazione degl'itinerari e passo i viaggi 
        return view('admin.steps.create', compact('travels', 'travel_id', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStepRequest $request)
    {
        // salvo i dati validati
        $val_data = $request->validated();

        // se nella richiesta ce image
        if ($request->has('image')) {

            // viene inserita l'immagine nello storage
            $val_data['image'] = Storage::disk('public')->put('uploads/images', $val_data['image']);
        } else {
        };

        // variabile che fa checker o salva il numero di travel con lo stesso nome
        $slug_checker = Step::where('name', $val_data['name'])->count();

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

        $val_data['date'] = str_replace('/', '-', $val_data['date']);
        $date = date_format(new DateTime($val_data['date']), 'Y-m-d');
        $val_data['date'] = $date;
        dd($val_data['date'], $date);
        // salvo nella variabile l'itinerario creato
        $newStep = Step::create($val_data);

        session_start();

        if ($_SESSION['travel-page'] === 'si') {

            $travel = Travel::where('id', $_SESSION['travel-id'])->first();

            return to_route('admin.travels.show', compact('travel'))->with('message', "Hai creato l'itineraio $newStep->name");
        }

        // renderizzo alla pagina index dell'itinerario con un messaggio per la session
        return to_route('admin.steps.index')->with('message', "Hai creato l'itineraio $newStep->name");
    }

    /**
     * Display the specified resource.
     */
    public function show(Step $step)
    {

        $dd = Http::get('https://api.tomtom.com/style/1/sprite/20.3.2-3/sprite@2x.png?key=k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd&traffic_incidents=incidents_s1&traffic_flow=flow_relative0-dark');
        // dd($response);

        $client = new Client();
        $address = urlencode($step->location);
        $response = $client->get('https://api.tomtom.com/search/2/geocode/%27.' . $address . '.%27.json', [
            'query' => [
                'key' => 'k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd',
                'limit' => 1
            ]
        ]);
        error_log(print_r($response, true));
        // dd($response->getBody(), $response);
        $data = json_decode($response->getBody(), true);
        // dd($data);
        $latitude = $data['results'][0]['position']['lat'];
        $longitude = $data['results'][0]['position']['lon'];
        // // salvo il viaggio dell'itinerario
        // $travel = Travel::where('id', $step->travel_id)->get();

        // se l'itinerario e quello creato dall'utente attualmente collegato
        if (Gate::allows('step_checker', $step)) {

            // renderizza alla pagina show dell'itinerario e passo il singolo itinerario
            return view('admin.steps.show', compact('step', 'latitude', 'longitude'));
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Step $step)
    {
        // // salvo il viaggio dell'itinerario
        // $travel = Travel::where('id', $step->travel_id)->get();

        // se l'itinerario e quello creato dall'utente attualmente collegato
        if (Gate::allows('step_checker', $step)) {

            // salvo in una variabile l'id dell'utente attualmente collegato
            $id = Auth::id();

            // salvo in una varibile tutti i viaggi dell'utente attaulmente collegato
            $travels = Travel::where('user_id', $id)->get();
            $date_active = date_format(new DateTime($step->date), 'd/m/Y');

            // renderizzo alla pagina di modifica dell'itinerario e passo gl'itinerari e viaggi
            return view('admin.steps.edit', compact('step', 'travels', 'date_active'));
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStepRequest $request, Step $step)
    {
        // se l'itinerario e quello creato dall'utente attualmente collegato
        if (Gate::allows('step_checker', $step)) {

            // salvo i dati validati
            $val_data = $request->validated();

            // se nella richiesta ce image
            if ($request->has('image')) {

                // se esiste l'immagine di travel
                if ($step->image) {

                    // l'immagine viene cancellata da storage
                    Storage::disk('public')->delete($step->image);
                }
                // imagine viene inserita in storage
                $val_data['image'] = Storage::disk('public')->put('uploads/images', $val_data['image']);
            }

            // variabile che fa checker o salva il numero di travel con lo stesso nome
            $slug_checker = Step::where('name', $val_data['name'])->count();

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


            // modifica travel con i nuovi dati
            $step->update($val_data);

            // renderizzo alla pagina index dell'itinerario con un messaggio per la session
            return to_route('admin.steps.index')->with('message', "Hai modificato l'itinerario: $step->name");
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Step $step, Request $request)
    {
        // se l'itinerario e quello creato dall'utente attualmente collegato
        if (Gate::allows('step_checker', $step)) {

            // se esiste l'immagine di travel
            if ($step->image) {

                // l'immagine viene cancellata da storage
                Storage::disk('public')->delete($step->image);
            }

            // variabile che salva il nome di step+
            $name = $step->name;

            // cancello step
            $step->delete();

            // inizializo page
            session_start();
            // se devo ritornare alla pagina show del viaggio
            if ($request['no-page'] === 'no') {

                $_SESSION['travel-page'] = 'no';
                // renderizzo alla pagina precedente con un messaggio per la session
                return redirect()->back()->with('message', "Hai cancellato il viaggio: $name");
            } else if ($request['no-page'] === 'si') {

                $travel = Travel::where('id', $request['travel_id'])->first();
                return to_route('admin.travels.show', compact('travel'))->with('message', "Hai cancellato il viaggio: $name");
            }

            // renderizzo alla pagina precedente con un messaggio per la session
            return redirect()->back()->with('message', "Hai cancellato il viaggio: $name");
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }
}
