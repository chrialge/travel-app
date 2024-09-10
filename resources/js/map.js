console.log('ciao')
document.getElementById('poiBoxInfo').style.display = 'none';
import tt from '@tomtom-international/web-sdk-maps';
import cc from '@tomtom-international/web-sdk-services';


const tomtomEl = document.getElementById('map_step');
const lngpos = tomtomEl.dataset.lon;
const latpos = tomtomEl.dataset.lat;
const API_KEY = 'k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd';
const APPLICATION_NAME = 'TravelBoo';
const APPLICATION_VERSION = '1.0';

console.log(tomtomEl, lngpos, latpos)
tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);
const Address = { lng: lngpos, lat: latpos };

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
    center: Address,
    zoom: 16,
});
map.on('mouseenter', 'POI', function () {
    map.getCanvas().style.cursor = "pointer";
})

map.on('mouseleave', 'POI', function () {
    map.getCanvas().style.cursor = "";
})

map.addControl(new tt.FullscreenControl());
map.addControl(new tt.NavigationControl());

var marker = new tt.Marker({
    color: '#E25B07',
}).setLngLat(Address).addTo(map);

marker.on('click', () => {
    console.log('bella')
    addMarkerPopup(Address);


})
map.on('click', function (event) {
    // query layer on point
    let count = 0
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
            document.getElementById('poiBoxInfo').style.display = 'none';
        }
    }


})


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

var addMarkerPopup = function (address) {
    cc.services.reverseGeocode({
        key: API_KEY,
        position: address
    }).then(response => console.log(response))
}