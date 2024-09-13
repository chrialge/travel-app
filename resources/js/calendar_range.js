// importo flatpickr ('libreria per gli input di tipo time aand date')
import flatpickr from "flatpickr";


// salv0 nella variabile il risultato della funzione
let date = dateNow(0);

//se l'emento ha l'attributo 'data-range' dell'elemento con l'id "date_range"
if (document.getElementById("date_range").hasAttribute('data-range')) {

    // salvo il valore dell'attributo 'data-range' dell'elemento con l'id "date_range"
    const dateRange = document.getElementById("date_range").dataset.range;

    // salvo le due date in array con indice diverso
    const dates = dateRange.split(",")

    // salvo la prima data splitata in 'begin'
    let begin = dates[0].split('-');

    // compongo la data d'inizio nella variabile 'begin'
    begin = begin[2] + '/' + begin[1] + '/' + begin[0]

    // salvo la seconda data splita in 'end'
    let end = dates[1].split('-');

    // compongo la data di fine nella variabile 'end'
    end = end[2] + '/' + end[1] + '/' + end[0]

    // uso la libreria per gli input date e time
    flatpickr("input[type='date']", {
        mode: "range",
        defaultDate: [begin, end],
        dateFormat: "d/m/Y",
        minDate: begin

    })
} else {//altrimenti

    // uso la libreria per gli input date e time
    flatpickr("input[type='date']", {
        mode: "range",
        defaultDate: [date, dateNow(7)],
        dateFormat: "d/m/Y",
        minDate: date

    })
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