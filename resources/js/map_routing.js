console.log('ciao')
document.getElementById('poiBoxInfo').style.display = 'none';
import { Formatters } from './formatter.js'

import tt from '@tomtom-international/web-sdk-maps';
import cc from '@tomtom-international/web-sdk-services';



const tomtomEl = document.getElementById('map_step');
const lngpos = tomtomEl.dataset.lon;
const latpos = tomtomEl.dataset.lat;
const time = tomtomEl.dataset.time;
const API_KEY = 'k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd';
const APPLICATION_NAME = 'TravelBoo';
const APPLICATION_VERSION = '1.0';

let arrayLong = lngpos.split(',');
let arrayLat = latpos.split(',');
let arraytime = time.split(',')
let arrayData = [];
for (let i = 0; i < arrayLong.length; i++) {
    const long = arrayLong[i];
    const lat = arrayLat[i];
    const time = arraytime[i];

    const object = {
        "long": long,
        "lat": lat,
        "time": time,
    }
    arrayData.push(object);
}
arrayData.sort(reorder)
function reorder(a, b) {
    if (a.time < b.time) {
        return -1;
    }
    else if (a.anno > b.anno) {
        return 1;
    }
    return 0;

}
console.log(arrayData)
console.log(arrayLat, arrayLong, arraytime, arrayData);


if (lngpos === '' || lngpos === " " || latpos === '' || latpos === ' ') {
    document.getElementById('map_step').style.display = 'none';
} else {
    console.log(tomtomEl, lngpos, latpos)
    tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);
    const Address = { lng: arrayLong[0], lat: arrayLat[0] };

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
        zoom: 6,
    });

    map.on('mouseenter', 'POI', function () {
        map.getCanvas().style.cursor = "pointer";
    })

    map.on('mouseleave', 'POI', function () {
        map.getCanvas().style.cursor = "";
    })

    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());

    var markers = []
    arrayData.forEach(element => {
        let pos = new tt.LngLat(element.long, element.lat)
        console.log(pos)
        var marker = new tt.Marker({
            color: '#E25B07',
        }).setLngLat(pos).addTo(map);
        // let marker = new tt.Marker().setLngLat(pos).addTo(map)
        markers.push(marker);
    })


    // marker.on('click', () => {
    //     console.log('bella')
    //     addMarkerPopup(Address);


    // })
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


}


function findFirstBuildingLayerId() {
    var layers = map.getStyle().layers;
    for (var index in layers) {
        if (layers[index].type === 'fill-extrusion') {
            return layers[index].id;
        }
    }
    throw new Error('Map style does not contain any layer with fill-extrusion type.');
}

map.once('load', function () {

    let routeOptions = {
        key: API_KEY,
        locations: []
    }
    console.log(markers)
    markers.forEach(marker => {
        console.log(marker)
        routeOptions.locations.push(marker.getLngLat())
    })
    cc.services.calculateRoute(routeOptions).then(
        function (routedata) {
            console.log(routedata)
            var geo = routedata.toGeoJson();
            console.log(geo)
            displayRoute(geo);
            var bounds = new tt.LngLatBounds();
            var coordinates = geo.features[0].geometry.coordinates[0];
            var lngLat = coordinates[Math.floor(coordinates.length / 2)];
            var summary = geo.features[0].properties.summary;
            console.log(bounds, coordinates, lngLat, summary);
            createPopup(summary, lngLat);
            coordinates.forEach(function (point) {
                bounds.extend(tt.LngLat.convert(point));
            });
            map.fitBounds(bounds, { duration: 0, padding: 105 });
            infoHint.setMessage('Hover over the route to display a popup with route information');
        }
    )

});

var displayRoute = function (geo) {
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


function createPopup(feature, lngLat) {
    let popup = new tt.Popup({ className: 'tt-popup', offset: [0, 18] })
        .setLngLat(lngLat)
        .setHTML(
            '<div class="tt-pop-up-container">' +
            '<div class="pop-up-content -small">' +
            '<div class="pop-up-result-address">' +
            'Distance: ' + Formatters.formatAsMetricDistance(feature.lengthInMeters) +
            '</div>' +
            '<div class="pop-up-result-address">' +
            'Estimated travel time: ' +
            Formatters.formatToDurationTimeString(feature.travelTimeInSeconds) +
            '</div>' +
            '<div class="pop-up-result-address">' +
            'Traffic delay: ' + Formatters.formatToDurationTimeString(feature.trafficDelayInSeconds) +
            '</div>' +
            '</div>' +
            '</div>'
        )
        .setMaxWidth('none');
    popup.addTo(map);
}