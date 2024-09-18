// importo la libreria per visualizzare la mappa
import tt from '@tomtom-international/web-sdk-maps';
// importo la libreri per i servizi della mappa
import cc from '@tomtom-international/web-sdk-services';
// importo la libreria di ricerca della mappa
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

// salvo la chiave dell'api
const API_KEY = 'k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd';
// salvo il nome dell web app
const APPLICATION_NAME = 'TravelBoo';
// salvo la sua versione
const APPLICATION_VERSION = '1.0';
// variabile in cui salvero il file JSON con lo stile della mappa
let datiJson;

// metodo in cui settero il nome e la versione della web app
tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);

// nascondo il container delle informazione delle posizioni
// cambio lo stile dell'elemento con l'id "poiBoxInfo"
document.getElementById('poiBoxInfo').style.display = 'none';


// try e catch per stampare eventuali errori 
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

    zoom: 1,
});

// setto le opzioni di ricerca
var searchOptions = {
    key: API_KEY,
    language: 'it-IT',
    limit: 10,
    idxSet: 'POI',
}

// setto il container del input di ricerca
var searchBoxOptions = {
    placeholder: 'Inserisci il luogo',
    name: 'location',
    minNumberOfCharacters: 2,
    searchOptions: searchOptions,
    cssStyleCheck: true,
}

// creo il container dell'input di ricerca
var ttSearchBox = new SearchBox(cc.services, searchBoxOptions);

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


// quando clico nella mappa
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


// quando sta caricando la mappa
map.on('load', function () {

    // nascondi il container delle informazioni
    hidePoiInfo();

    // inserisco la searchbox
    document.querySelector('.tt-side-panel_header').appendChild(ttSearchBox.getSearchBoxHTML());

    // invoco la funzione
    updateSearchOptions(map)

    // salvo input della searchbox
    let inputEl = document.querySelector('.tt-search-box-input');

    // aggiungo gli attributi alla searchbox
    inputEl.setAttribute("id", "location")
    inputEl.setAttribute("onblur", "check_location()")
    inputEl.setAttribute("onkeyup", "hide_location_error()")

    // se esiste l'elemento con l'id "search_location"
    if (document.getElementById('search_location')) {

        //salvo il valore dell'attributo 'data-location' del elemento con l'id "search-location"
        const location = document.getElementById('search_location').dataset.location;

        // salvo come valore dell'input il valore della variabile 'location'
        inputEl.value = location;
    }
})

// quando selezioni il risultato
ttSearchBox.on('tomtom.searchbox.resultselected', function (event) {

    // prendo l'elemento l'input della searchbox
    let searchInputEl = document.querySelector('.tt-search-box-input');

    // setto gli attributi dell'input
    searchInputEl.setAttribute("name", "location");
    searchInputEl.setAttribute("id", "location")
    searchInputEl.setAttribute("onblur", "check_location()")
    searchInputEl.setAttribute("onkeyup", "hide_location_error()")

    // se il risultato e di tipo 'POI'
    if (event.data.result.type === 'POI') {

        // invoco la funzione che mostra le informazioni della "POI"
        displayPOIInformation(event.data.result.address.freeformAddress, event.data.result.position)
        //invoca funzione che sposta la mappz
        moveMap(event.data.result.position);
    }

})


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
 * funzione che inserisce i possibili risultati della ricerca
 * @param {element} map 
 */
var updateSearchOptions = function (map) {

    // prendo le opzioni
    let options = ttSearchBox.getOptions();
    // prendo i limiti geografici
    options.searchOptions.boundingBox = map.getBounds();
    // aggiorno le opzioni
    ttSearchBox.updateOptions(options);
}

/**
 * funzione che sposta la posizione della mappa
 * @param {object | array} lgnlat 
 */
var moveMap = function (lgnlat) {

    // la mappa si sposta
    map.flyTo({
        center: lgnlat,
        zoom: 16,
    })

    // aggiungo un marker sulla posizione
    let marker = new tt.Marker({ color: '#e25b07' }).setLngLat(lgnlat).addTo(map)
}

