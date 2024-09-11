import './bootstrap';
import '~resources/scss/app.scss';
import flatpickr from "flatpickr";
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])
// document.getElementById('poiBoxInfo').style.display = 'none';
if (document.readyState === "loading" || document.readyState === "interactive") {
    // console.log('caricamento')

    document.getElementById('app').style.display = 'block';


    window.addEventListener('load', function () {

        // console.log('fine caricamento')
        if (this.innerWidth >= "500px") {
            console.log('bel34576')
            const sidebarPcEl = document.getElementById('sidebar_pc');
            sidebarPcEl.classList.add('sidebar-narrow-unfoldable')
        }

        // console.log(document.getElementById('app'));
        document.getElementById('app').style.display = 'block';

        document.getElementById('loading').style.display = 'none';
    });

} else {
    // console.log('fine caricamento')

    document.getElementById('app').style.display = 'block';
    document.getElementById('loading').style.display = 'none';
}

console.log(innerWidth);



document.getElementById('siderbar_phone_container').addEventListener('click', (e) => {

    e.preventDefault();

    const sidebarPcEl = document.getElementById('sidebar_pc');
    sidebarPcEl.classList.remove('sidebar-narrow-unfoldable')
    if (sidebarPcEl.style.display === 'flex') {

        sidebarPcEl.style.display = 'none';
    } else {
        sidebarPcEl.style.display = 'flex'
    }

})

let calendar = flatpickr("input[type='date']", {
    dateFormat: "d/m/Y",
})

let eleselect = document.getElementById('travel_id')
let dateel = document.getElementById('date');
dateel.addEventListener('click', function (e) {
    let input = document.getElementById("date");
    console.log(input.value);
    let index = eleselect.selectedIndex;
    let value = eleselect.options[index].value;
    e.preventDefault()
    if (value !== 'Select one') {


        // try e catch per stampare eventuali errori 
        try {

            asycCall(value);
            // salvo la risposta

            // // salvo il file Json


        } catch (error) {
            console.error(error);
            // Expected output: ReferenceError: nonExistentFunction is not defined
            // (Note: the exact output may be browser-dependent)
        }
        console.log(index, value);

    }
})


async function asycCall(value) {
    const response = await fetch(`http://127.0.0.1:8000/api/date-travel/${value}`);
    const datiJson = await response.json();
    console.log(response,);
    calendar.set('minDate', datiJson['response']['begin']);
    calendar.set('maxDate', datiJson['response']['end']);
}