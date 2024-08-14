import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])
// window.addEventListener('load', function () {
//     console.log(document.getElementById('app'));

//     document.getElementById('loading').style.display = 'block';
// });

// // window.onload

// window.addEventListener("DOMContentLoaded", () => {
//     // your functions here
// });

const ratings = document.getElementById('rating1'); const rating1 = new CDB.Rating(ratings);
rating1.getRating;
