

import tt from '@tomtom-international/web-sdk-maps';
import cc from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

const API_KEY = 'k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd';
const APPLICATION_NAME = 'TravelBoo';
const APPLICATION_VERSION = '1.0';


document.getElementById('poiBoxInfo').style.display = 'none';

tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);

let gg = document.querySelector('.tt-search-box-input');
// gg.setAttribute("id", "location")
// gg.setAttribute("onblur", "check_location()")
// gg.setAttribute("onkeyup", "hide_location_error()")
console.log(gg)



var markerHeight = 50, markerRadius = 10, linearOffset = 25;
var popupOffsets = {
    'top': [0, 0],
    'top-left': [0, 0],
    'top-right': [0, 0],
    'bottom': [0, -markerHeight],
    'bottom-left': [linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
    'bottom-right': [-linearOffset, (markerHeight - markerRadius + linearOffset) * -1],
    'left': [markerRadius, (markerHeight - markerRadius) * -1],
    'right': [-markerRadius, (markerHeight - markerRadius) * -1]

};

// variabile in cui salvero il file JSON con lo stile della mappa
let datiJson;

// try e catch per stampare eventuali errori 
try {
    // salvo la risposta
    const response = await fetch('https://api.tomtom.com/style/2/custom/style/dG9tdG9tQEBAbm9IdVZheUZ6NHFHb004Zzs5OTVmMDNlMC1kOWNlLTRiOWItOGM4ZC00NzE5Nzg3YThjZWQ=/drafts/0.json?key=k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd');
    // salvo il file Json
    datiJson = await response.json();
} catch (error) {
    console.error(error);
    // Expected output: ReferenceError: nonExistentFunction is not defined
    // (Note: the exact output may be browser-dependent)
}


var map = tt.map({
    key: API_KEY,
    language: 'it-IT',
    container: 'map_step',
    style: datiJson,
    zoom: 1,
});
map.on('mouseenter', 'POI', function () {
    map.getCanvas().style.cursor = "pointer";
})

map.on('mouseleave', 'POI', function () {
    map.getCanvas().style.cursor = "";
})

map.addControl(new tt.FullscreenControl());
map.addControl(new tt.NavigationControl());

// var marker = new tt.Marker({
//     color: '#E25B07',
// }).setLngLat(Address).addTo(map);

map.on('click', function (event) {
    // query layer on point
    let count = 0;
    var touchingLayer = map.queryRenderedFeatures(event.point);

    // if POI then display using the id
    for (let index = 0; index < touchingLayer.length; index++) {

        const sigleFeauture = touchingLayer[index];
        if (sigleFeauture.layer.id === 'POI') {

            document.getElementById('poiBoxInfo').style.display = 'block';

            displayPOIInformation(sigleFeauture.properties.name, sigleFeauture.geometry.coordinates)
        } else {
            count++
        }
        if (count === touchingLayer.length) {
            // console.log(count, touchingLayer.length)
            hidePoiInfo();

        }
    }


})

var hidePoiInfo = function () {
    document.getElementById('poiBoxInfo').style.display = 'none';
}
var displayPOIInformation = function (name, pos) {

    // console.log(pos)
    cc.services.fuzzySearch({
        key: API_KEY,
        query: name,
        center: pos
    }).then(function (response) {
        console.log(response)
        if (response.results.length > 0) {
            cc.services.placeById({
                key: API_KEY,
                language: 'it-IT',
                entityId: response.results[0].id,

            }).then(function (response) {
                console.log(response)
                var firstResult = response.results[0];
                if (response.results.length > 0) {

                    if (firstResult.poi) {
                        if (firstResult.poi.name) {
                            document.getElementById('poiname').innerHTML = firstResult.poi.name
                        }
                        if (firstResult.poi.categories) {
                            let markup = [];
                            for (let index = 0; index < firstResult.poi.categories.length; index++) {
                                const element = firstResult.poi.categories[index];
                                let badge = `<span class="badge pb-1 pe-1" style="background-color: black; font-size: 12px">${element}</span>`

                                markup.push(badge)
                            }
                            document.getElementById('poicategories').innerHTML = markup
                        }
                        if (firstResult.poi.phone) {
                            document.getElementById('poiphone').innerHTML = `
                            <<i class="fa fa-phone" aria-hidden="true"></i>
                            <span class="ps-1">${firstResult.poi.phone}</span>`
                        }
                        if (firstResult.address.freeformAddress) {
                            document.getElementById('poiaddress').innerHTML = `
                            <i class="fa fa-street-view" aria-hidden="true"></i>
                            <span class="ps-1">${firstResult.address.freeformAddress}</span>`
                        }

                        if (firstResult.poi.url) {
                            document.getElementById('url').innerHTML = `<a href="https://${firstResult.poi.url}" target="_blank">vai sul sito</a>`
                        }

                        if (firstResult.dataSources) {
                            const id = firstResult.dataSources
                            console.log(id)
                        }
                    }

                } else {
                    document.getElementById('poiname').innerHTML = "cc";

                }


            })
        } else {
            document.getElementById('poiname').innerHTML = "Mi dispiace per questo posto non abbiamo informazioni"
            document.getElementById('poicategories').innerHTML = '';
            document.getElementById('poiphone').innerHTML = '';
            document.getElementById('poiaddress').innerHTML = '';
            document.getElementById('url').innerHTML = '';
        }

    })
}
var searchOptions = {
    key: API_KEY,
    language: 'it-IT',
    limit: 10,
    idxSet: 'POI',
}
var searchBoxOptions = {
    placeholder: 'Inserisci il luogo',
    name: 'location',
    minNumberOfCharacters: 2,
    searchOptions: searchOptions,
    cssStyleCheck: true,
}
var ttSearchBox = new SearchBox(cc.services, searchBoxOptions);

var updateSearchOptions = function () {
    let options = ttSearchBox.getOptions();
    options.searchOptions.boundingBox = map.getBounds();
    ttSearchBox.updateOptions(options);
    console.log(options)
}

map.on('dragend', function () {

})

map.on('load', function () {

    hidePoiInfo();
    document.querySelector('.tt-side-panel_header').appendChild(ttSearchBox.getSearchBoxHTML());
    let options = ttSearchBox.getOptions()
    options.searchOptions.boundingBox = map.getBounds();
    ttSearchBox.updateOptions(options);
    let gg = document.querySelector('.tt-search-box-input');
    gg.setAttribute("id", "location")
    gg.setAttribute("onblur", "check_location()")
    gg.setAttribute("onkeyup", "hide_location_error()")
    if (document.getElementById('search_location')) {
        const location = document.getElementById('search_location').dataset.location
        gg.value = location
    }



})



let searchInputEl = document.querySelector('.tt-search-box');
console.log(searchInputEl);


ttSearchBox.on('tomtom.searchbox.resultselected', function (event) {
    let searchInputEl = document.querySelector('.tt-search-box-input');

    searchInputEl.setAttribute("name", "location");
    searchInputEl.setAttribute("id", "location")
    searchInputEl.setAttribute("onblur", "check_location()")
    searchInputEl.setAttribute("onkeyup", "hide_location_error()")



    console.log(searchInputEl);
    console.log(event.data.result);
    if (event.data.result.type === 'POI') {
        displayPOIInformation(event.data.result.address.freeformAddress, event.data.result.position)
        moveMap(event.data.result.position);
    }

})

var moveMap = function (lgnlat) {
    map.flyTo({
        center: lgnlat,
        zoom: 16,
    })

    let marker = new tt.Marker({ color: '#e25b07' }).setLngLat(lgnlat).addTo(map)
    let dd = ttSearchBox.getOptions();
    console.log(dd)
}

