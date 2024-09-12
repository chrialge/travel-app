import flatpickr from "flatpickr";

let dateValue = document.getElementById('date').value
let dateDataValue = document.getElementById('date').dataset.value
dateValue = dateDataValue;
console.log(dateDataValue, dateValue)
dateDataValue = dateDataValue.split('-');
dateValue = dateDataValue[2] + '/' + dateDataValue[1] + '/' + dateDataValue[0]


let calendar = flatpickr("input[type='date']", {
    defaultDate: dateValue,
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