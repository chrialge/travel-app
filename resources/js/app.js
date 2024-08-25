import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


if (document.readyState === "loading" || document.readyState === "interactive") {
    console.log('caricamento')

    document.getElementById('app').style.display = 'block';


    window.addEventListener('load', function () {
        console.log('fine caricamento')

        console.log(document.getElementById('app'));
        document.getElementById('app').style.display = 'block';

        document.getElementById('loading').style.display = 'none';
    });

} else {
    console.log('fine caricamento')

    document.getElementById('app').style.display = 'block';
    document.getElementById('loading').style.display = 'none';
}

// const API_KEY = 'k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd';
// const APPLICATION_NAME = 'TravelBoo';
// const APPLICATION_VERSION = '1.0';

// const GOLDEN_GATE_BRIDGE = { lng: -122.47483, lat: 37.80776 };

// var map = tt.map({
//     key: API_KEY,
//     container: 'tom_tom',
//     center: GOLDEN_GATE_BRIDGE,
//     zoom: 12
// });

// tt.services.fuzzySearch({
//     key: API_KEY,
//     query: 'Golden Gate Bridge'
// })
//     .go()
//     .then(function (response) {
//         map = tt.map({
//             key: API_KEY,
//             container: 'tom_tom',
//             center: response.results[0].position,
//             zoom: 12
//         });
//     });