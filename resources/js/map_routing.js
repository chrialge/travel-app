// importo la libreria per visualizzare la mappa
import tt from '@tomtom-international/web-sdk-maps';
// importo la libreri per i servizi della mappa
import cc from '@tomtom-international/web-sdk-services';
// importo la classe formatter di tomtom
import { Formatters } from './formatter.js'

// salvo l'elemento con l'id "map_step" (il contenitore in cui sara inserita la mappa di TomTom)
const tomtomEl = document.getElementById('map_step');
// salvo il valore dell'attributo 'data-lon' dell'elemento con l'id "map_step"
const lngpos = tomtomEl.dataset.lon;
// salvo il valore dell'attributo 'data-lat' dell'elemento con l'id "map_step" 
const latpos = tomtomEl.dataset.lat;
// salvo il valore dell'attributo 'data-time' dell'elemento con l'id "map_step" 
const time = tomtomEl.dataset.time;
// variabile in cui salvero il file JSON con lo stile della mappa
let datiJson;
// salvo la chiave dell'api
const API_KEY = 'k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd';
// salvo il nome dell web app
const APPLICATION_NAME = 'TravelBoo';
// salvo la sua versione
const APPLICATION_VERSION = '1.0';

// metodo in cui settero il nome e la versione della web app
tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);

// nascondo il container delle informazione delle posizioni
// cambio lo stile dell'elemento con l'id "poiBoxInfo"
document.getElementById('poiBoxInfo').style.display = 'none';

// splitto la variabile 'lngpos'
let arrayLong = lngpos.split(',');
// splitto la variabile 'latpos'
let arrayLat = latpos.split(',');
// splitto la variabile 'time'
let arraytime = time.split(',')
// creao un array di ancoraggio
let arrayData = [];

// ciclo per tutta l'array
for (let i = 0; i < arrayLong.length; i++) {

    // salvo la singola longitudine
    const long = arrayLong[i];
    // salvo la singola latitudine
    const lat = arrayLat[i];
    // salvo il singolo tempo
    const time = arraytime[i];

    // creo la struttura dell'oggetto
    const object = {
        "long": long,
        "lat": lat,
        "time": time,
    }
    // pusho nell'array l'oggetto
    arrayData.push(object);
}
// salvo in oggetto la variabile 'lngpos' 'latpos'
const Address = { lng: arrayLong[0], lat: arrayLat[0] };

// array che viene ordinata in base alla funzione 'reorder'
arrayData.sort(reorder)


//se almeno una delle seguenti variabili e vuota
if (lngpos === '' || time === " " || latpos === '') {

    // nascondo la mappa
    document.getElementById('map_step').style.display = 'none';
} else {


    try {
        (async function () {
            const response = await Promise.resolve(fetch('https://api.tomtom.com/style/2/custom/style/dG9tdG9tQEBAbm9IdVZheUZ6NHFHb004Zzs5OTVmMDNlMC1kOWNlLTRiOWItOGM4ZC00NzE5Nzg3YThjZWQ=/drafts/0.json?key=k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd'));
            datiJson = await response.json();
            console.log(response, datiJson);

        }());

    } catch (error) {
        console.error(error);
        // Expected output: ReferenceError: nonExistentFunction is not defined
        // (Note: the exact output may be browser-dependent)
    }
    console.log(datiJson);

    // setto la mappa
    var map = tt.map({
        key: API_KEY,
        language: 'it-IT',
        container: 'map_step',
        style: datiJson,
        center: Address,
        zoom: 16,
    });

    // aggiungo alla mappa il controller per visualizzare full-screen
    map.addControl(new tt.FullscreenControl());

    // aggiungo alla mappa controller per navigare con i bottoni
    map.addControl(new tt.NavigationControl());

    // quando nella mappa si va sua posizione con il marker
    map.on('mouseenter', 'POI', function () {

        // il cursore diventa di tipo 'pointer'
        map.getCanvas().style.cursor = "pointer";
    })

    // quando nella mappa non sono sopra a una posizione con il marker
    map.on('mouseleave', 'POI', function () {

        // cursore di default
        map.getCanvas().style.cursor = "";

    })

    // creo una array di ancoraggio
    var markers = []

    // ciclo nell'array
    arrayData.forEach(element => {

        //prendo la posizione per il singolo elemento
        let pos = new tt.LngLat(element.long, element.lat)

        //aggiungo il marker per la singola posizione
        var marker = new tt.Marker({
            color: '#E25B07',
        }).setLngLat(pos).addTo(map);

        // pusho i valori dei marker nell'array 'markers'
        markers.push(marker);
    })
    map.on('click', function (event) {

        // variabile che uso come contatore
        let count = 0;

        // salvo una serie di valori 'touchingLayer' che mi da quando clicco sulla mappa
        var touchingLayer = map.queryRenderedFeatures(event.point);

        // itero su una serie valori 'touchingLayer' che mi ha dato
        for (let index = 0; index < touchingLayer.length; index++) {

            // salvo la singola serie 'sigleFeauture' di valori
            const sigleFeauture = touchingLayer[index];

            // se la singola serie di valore viene definita come 'POI'
            if (sigleFeauture.layer.id === 'POI') {

                // invoco la funzione che mi fara compare le informazioni
                displayPOIInformation(sigleFeauture.properties.name, sigleFeauture.geometry.coordinates);
            } else {//altrimenti

                // incremento il contatore
                count++;
            }
            // se il contatore e uguale al numero di serie di valori 'touchingLayer'
            if (count === touchingLayer.length) {

                // scompare il panello con le informazioni
                hidePoiInfo();
            }
        }
    })
}


// quando la mappas sta caricando
map.once('load', function () {

    // le opzioni per la rotta
    let routeOptions = {
        key: API_KEY,
        locations: []
    }

    // itero in maekers
    markers.forEach(marker => {

        // pusho le posizioni dei marker
        routeOptions.locations.push(marker.getLngLat())
    })
    // uso il metodo per calcolare la strada
    cc.services.calculateRoute(routeOptions).then(routedata => {

        // invoco la funzione con i dati
        streetData(routedata)
    })

});


/**
 * funzione che confronta la data
 * @param {object} a primo elemnto
 * @param {object} b secondo elemento
 * @returns 
 */
function reorder(a, b) {
    if (a.time < b.time) {
        return -1;
    }
    else if (a.anno > b.anno) {
        return 1;
    }
    return 0;

}

/**
 * funzione che nasconde il container delle informazioni
 */
var hidePoiInfo = function () {
    document.getElementById('poiBoxInfo').style.display = 'none';
}

/**
 * funzione che mi fa comparire le informazioni dei 'POI'
 * @param {string} name il nome del luogo
 * @param {object} pos la posizione del luogo
 */
var displayPOIInformation = function (name, pos) {

    // metodo che mi da una serie di informazioni (mi serve l'id del POI)
    cc.services.fuzzySearch({
        key: API_KEY,
        query: name,
        center: pos
    }).then(function (response) {

        // se la risposta contiene piu di un elemento
        if (response.results.length > 0) {

            // uso la libreria che mi da le informzioni del 'POI'
            cc.services.placeById({
                key: API_KEY,
                language: 'it-IT',
                entityId: response.results[0].id,

            }).then(function (response) {

                // salvo il risultato
                var firstResult = response.results[0];

                // se la risposta contiene piu di 0 risultati
                if (response.results.length > 0) {

                    // se contiene la chiave 'poi' nel primo risultato
                    if (firstResult.poi) {

                        // se contiene il nome
                        if (firstResult.poi.name) {

                            // inserisco il nome nell'elemento con l'id "poiname"
                            document.getElementById('poiname').innerHTML = firstResult.poi.name
                        }

                        // se contiene le categoruie
                        if (firstResult.poi.categories) {

                            // array di ancoraggio
                            let markup = [];

                            // itero per tutte le categorie
                            for (let index = 0; index < firstResult.poi.categories.length; index++) {

                                // prendo la singola categoria
                                const element = firstResult.poi.categories[index];

                                // creo un il markup dei badge per la singola categoria
                                let badge = `<span class="badge pb-1 pe-1" style="background-color: black; font-size: 12px">${element}</span>`;

                                // pusho in 'markup' i badge
                                markup.push(badge);
                            }
                            // inserisco le categorie nell'elemento con l'id "piocategories"
                            document.getElementById('poicategories').innerHTML = markup;
                        }

                        // se esiste il numero
                        if (firstResult.poi.phone) {

                            // inserisco il numero con il markup nell'elemento con l'id "poiphone"
                            document.getElementById('poiphone').innerHTML = `
                            <<i class="fa fa-phone" aria-hidden="true"></i>
                            <span class="ps-1">${firstResult.poi.phone}</span>`;
                        }

                        //se esiste l'indirizzo
                        if (firstResult.address.freeformAddress) {

                            // inserisco l'indirizzo con il markup nell'elemento con l'id "poiaddress"
                            document.getElementById('poiaddress').innerHTML = `
                            <i class="fa fa-street-view" aria-hidden="true"></i>
                            <span class="ps-1">${firstResult.address.freeformAddress}</span>`;
                        }

                        // se esiste il sito
                        if (firstResult.poi.url) {
                            // inserisco il sito con il markup nell'elemento con l'id "url"
                            document.getElementById('url').innerHTML = `<a href="https://${firstResult.poi.url}" target="_blank">vai sul sito</a>`;
                        }

                        // mosto il container delleinformazioni
                        document.getElementById('poiBoxInfo').style.display = 'block';
                    }

                } else {//altrimenti

                    // inserisco messaggio errore nell'elemento con l'id "poiname"
                    document.getElementById('poiname').innerHTML = "trovati troppi risultati";

                    // mostro il conteiner delle informazioni
                    document.getElementById('poiBoxInfo').style.display = 'block';
                }
            })
        } else {//altrimenti

            // inserisco messaggio di default per 0 risultati
            document.getElementById('poiname').innerHTML = "Mi dispiace per questo posto non abbiamo informazioni";

            // svuoto l'elemento con l'id "poicategories"
            document.getElementById('poicategories').innerHTML = '';

            // svuoto l'elemento con l'id "poiphone"
            document.getElementById('poiphone').innerHTML = '';

            // svuoto l'elemento con l'id "poiaddress"
            document.getElementById('poiaddress').innerHTML = '';

            // svuoto l'elemento con l'id "url"
            document.getElementById('url').innerHTML = '';
        }

    })
}

/**
 * funzione che costruisce la rotta
 * @returns l'id del layer
 */
function findFirstBuildingLayerId() {
    var layers = map.getStyle().layers;
    for (var index in layers) {
        if (layers[index].type === 'fill-extrusion') {
            return layers[index].id;
        }
    }
    throw new Error('Map style does not contain any layer with fill-extrusion type.');
}

/**
 * funzine che inserisce l'itinerario
 * @param {object} geo 
 */
var displayRoute = function (geo) {

    // aggiungio un layer
    map.addLayer({
        'id': 'route',
        'type': 'line',
        'source': {
            'type': 'geojson',
            'data': geo
        },
        'paint': {
            'line-color': '#4a90e2',
            'line-width': 8
        }
    }, findFirstBuildingLayerId());
}

/**
 * funzione che crea un poupup che mostra la distanza e il tempo richiesto (veicolo=macchin)
 * @param {object} feature 
 * @param {object|array} lngLat 
 */
function createPopup(feature, lngLat) {

    // creo un nuovo popup
    let popup = new tt.Popup({ className: 'tt-popup', offset: [0, 18] })
        .setLngLat(lngLat)
        .setHTML(
            '<div class="tt-pop-up-container">' +
            '<div class="pop-up-content -small">' +
            '<div class="pop-up-result-address">' +
            'Distanza: ' + Formatters.formatAsMetricDistance(feature.lengthInMeters) +
            '</div>' +
            '<div class="pop-up-result-address">' +
            'Stimato il tempo di viaggio: ' +
            Formatters.formatToDurationTimeString(feature.travelTimeInSeconds) +
            '</div>' +
            '<div class="pop-up-result-address">' +
            'Ritardo a causa del traffico: ' + Formatters.formatToDurationTimeString(feature.trafficDelayInSeconds) +
            '</div>' +
            '</div>' +
            '</div>'
        )
        .setMaxWidth('none');

    // aggiungo il popup alla mappa
    popup.addTo(map);
}

/**
* funzione che mostra il percorso 
* @param {object} routedata ci sono i dati del percorso
*/
function streetData(routedata) {

    // salva la posizione
    var geo = routedata.toGeoJson();

    // invoco la funzione la strada
    displayRoute(geo);

    // prendo le coordinata iniziale
    var coordinates = geo.features[0].geometry.coordinates[0];
    // calcolo la posizione del popup
    var lngLat = geo.features[0].geometry.coordinates[coordinates.length / 2];
    // salvo i dati del percoso
    var summary = geo.features[0].properties.summary;

    // invoco la funzione per creare un popup
    createPopup(summary, lngLat);

}