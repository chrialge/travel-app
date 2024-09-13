// importo flatpickr ('libreria per gli input di tipo time aand date')
import flatpickr from "flatpickr";

// salvo il valore dell'elemento con l'id "date"
let dateValue = document.getElementById('date').value

// salvo l'elemento con l'id "travel_id"
let eleselect = document.getElementById('travel_id')

// salvo l'elemento con l'id "date"
let dateel = document.getElementById('date');

// se ce un valore nell'attributo 'data-value' dell'elemento con l'id "date"
if (document.getElementById('date').dataset.value) {

    // salvo il valore dell'attributo 'data-value dell'elemento con l'id "data-value"
    let dateDataValue = document.getElementById('date').dataset.value

    // se la stinga contiene '-'
    if (dateDataValue.includes('/')) {

        // salvo il valore della variabile 'dateDataValue' nella variabile 'dateValue'
        dateValue = dateDataValue;

    } else if (dateDataValue.includes('-')) {//altrimenti se contiene '-'
        // salvo il risultato splittato
        dateDataValue = dateDataValue.split('-')
        // compongo la data e la salvo nella varibile 'dateValue'
        dateValue = dateDataValue[2] + '/' + dateDataValue[1] + '/' + dateDataValue[0]

    }





}

// salvo il calendario dell'elemento con il selettore 'input[type='date']'
let calendar = flatpickr("input[type='date']", {
    defaultDate: dateValue,
    dateFormat: "d/m/Y",
})

if (document.getElementById("time_start").hasAttribute('date-timestart')) {

    const time_start = document.getElementById("time_start").dataset.timestart;
    const time_arrived = document.getElementById("time_arrived").dataset.timearrived;
    let timeStart = flatpickr("input[type='time_start']", {

        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,

        maxTime: time_arrived,
    })

    let timeArrived = flatpickr("input[type='time_arrived']", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minTime: time_start,


    })

    // invoco la funzione per settare l'ora massima e minima
    setTimePicker(time_start, time_arrived);

} else {
    // salvo il timer dell'elemento con il selettore 'input[type='time_start']'
    let time_start = flatpickr("input[type='time_start']", {
        theme: "light",
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minTime: "00:00"
    })

    // salvo il timer dell'elemento con il selettore 'input[type='time_arrived']'
    let time_arrived = flatpickr("input[type='time_arrived']", {
        theme: "dark",
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        maxTime: "23:59"

    })

    // invoco la funzione per settare l'ora massima e minima
    setTimePicker(time_start, time_arrived);
}

// quando si clicca sull'elemento con l'id "date"
dateel.addEventListener('click', function (e) {

    // salvo l'emento con l'id "date"
    let input = document.getElementById("date");

    // salvo l'indice delle opzione scelta nel select con l'id "travel_id"
    let index = eleselect.selectedIndex;

    // salvo il valore della opzione selezionata
    let value = eleselect.options[index].value;

    // prevengo i comportamenti di default
    e.preventDefault()

    // se il valore della variabile 'value' e diverso da 'Select one'
    if (value !== 'Select one') {

        // try e catch per stampare eventuali errori 
        try {

            // invoco la fuzione
            asycCall(value);

        } catch (error) {//se ci sono errori li cattura

            // stampa gli errori
            console.error(error);
            // Expected output: ReferenceError: nonExistentFunction is not defined
            // (Note: the exact output may be browser-dependent)
        }

    }
})

/**
 * funzione che fa una chiamata api 
 * @param {number} value l'indice del viaggio
 */
async function asycCall(value) {

    // la risposta della chiamata
    const response = await fetch(`http://127.0.0.1:8000/api/date-travel/${value}`);

    // trasforma la chiamata in una risposta ma di tipo json
    const datiJson = await response.json();

    // setto la data minima del caledario
    calendar.set('minDate', datiJson['response']['begin']);

    // setto la data massima del caledario
    calendar.set('maxDate', datiJson['response']['end']);
}

/**
 * funzione rida una data che parte con il giorno corrente e cambia in base al parametro
 * @param {number} addDay numero intero che aggiunge giorni alla data corrente
 * @returns data
 */
function dateNow(addDay) {
    var data = new Date();
    var gg, mm, aaaa;
    gg = data.getDate() + addDay + "/";
    mm = data.getMonth() + 1 + "/";
    aaaa = data.getFullYear();
    return gg + mm + aaaa;
}


/**
 * funzione che setta l'ora massima e minima dei timer
 * @param {Element} time_start il timer dell'elemento con il selettore 'input[type='time_start']'
 * @param {Element} time_arrived il timer dell'elemento con il selettore 'input[type='time_arrived']'
 */
function setTimePicker(time_start, time_arrived) {
    // quando e in sato di blur l'elemento con l'id "time_start"
    document.getElementById("time_start").addEventListener('blur', function (e) {

        // salvo il valore dell'elemento con l'id time_arrived
        const value = document.getElementById("time_arrived").value;

        // imposto l'attributo maxTime del timer con il selettore 'input[type='time_start']'
        time_start.set('maxTime', value);
    })

    // quando e in sato di blur l'elemento con l'id "time_arrived"
    document.getElementById("time_arrived").addEventListener('blur', function (e) {

        // salvo il valore dell'elemnto con l'id "time_arrived"
        const value = document.getElementById("time_start").value;

        // imposto l'attributo minTime del timer con il selettore 'input[type='time_arrived']'
        time_arrived.set('minTime', value);
    })
}