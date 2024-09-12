import flatpickr from "flatpickr";

let dateValue = document.getElementById('date').value
if (document.getElementById('date').dataset.value) {
    let dateDataValue = document.getElementById('date').dataset.value
    dateValue = dateDataValue;
    dateDataValue = dateDataValue.split('-');
    dateValue = dateDataValue[2] + '/' + dateDataValue[1] + '/' + dateDataValue[0]
}



let calendar = flatpickr("input[type='date']", {
    defaultDate: dateValue,
    dateFormat: "d/m/Y",

})

let time_start = flatpickr("input[type='time_start']", {
    theme: "light",
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    minTime: "00:00"
})

let time_arrived = flatpickr("input[type='time_arrived']", {
    theme: "dark",
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    maxTime: "23:59"

})



document.getElementById("time_start").addEventListener('blur', function (e) {
    const value = document.getElementById("time_arrived").value;

    time_start.set('maxTime', value);



})

document.getElementById("time_arrived").addEventListener('blur', function (e) {
    const value = document.getElementById("time_start").value;

    time_arrived.set('minTime', value);



})

if (document.getElementById("time_start")) {

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
}



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
