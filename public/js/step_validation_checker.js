
let count = 0;
const compiledField = document.getElementById('compiled_field')

function check_name() {
    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("name_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("name");

    // Verifico se la lunghezza del nome è di almeno 3 caratteri
    if (input.value.length >= 3 || input.value.length >= 50) {

        if (count === 1) {
            compiledField.classList.add('error_invisible')
            count--;

        } else if (count > 1) {
            count--;
        }

        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";

        return true;
    } else {

        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        input.style.borderColor = "red";



        return false;
    }
}

function check_date() {


    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("date_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("date");

    // Verifico se la lunghezza e uguale a 10
    if (input.value.length === 10) {

        if (count === 1) {
            compiledField.classList.add('error_invisible')
            count--;

        } else if (count > 1) {
            count--;
        }
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";

        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        input.style.borderColor = "red";

        return false;
    }
}

function check_time_start() {

    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("time_start_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("time_start");





    // Verifico se la lunghezza e uguale a 5
    if (input.value.length === 5) {


        if (count === 1) {
            compiledField.classList.add('error_invisible')
            count--;

        } else if (count > 1) {
            count--;
        }

        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";

        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        input.style.borderColor = "red";

        return false;
    }
}

function check_time_arrived() {

    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("time_arrived_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("time_arrived");


    // Verifico se la lunghezza e uguale a 5
    if (input.value.length === 5) {

        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";

        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        input.style.borderColor = "red";

        return false;
    }
}


function check_location() {
    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("location_error");

    let borderel = document.querySelector('div.tt-search-box-input-container');


    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("location");
    if (input.value.length >= 3) {

        if (count === 1) {
            compiledField.classList.add('error_invisible')
            count--;
            console.log(count, 'deve scomparire')

        } else if (count > 1) {
            count--;
            console.log(count, 'non deve scomparire')
        }

        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        borderel.style.borderColor = "";

        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        borderel.style.border = "2px solid red";

        return false;
    }


}






function hide_name_error() {
    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("name_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("name");

    // Verifico se la lunghezza del nome è di almeno 3 caratteri
    if (input.value.length >= 3) {
        if (count === 1) {
            count--;
            compiledField.classList.add('error_invisible')
        }

        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    } else {
        if (count === 0) {
            count++;
            compiledField.classList.remove('error_invisible')
        }
    }



}


function hide_date_error() {
    console.log(document.getElementById('travel_id'));
    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("date_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("date")


    // Verifico se la lunghezza  è uguale a 10 caratteri
    if (input.value.length === 10) {
        if (count === 1) {
            count--;
            compiledField.classList.add('error_invisible')
        }

        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    } else {
        if (count === 0) {
            count++;
            compiledField.classList.remove('error_invisible')
            console.log(count, compiledField, 'non e giusta ')
        }
    }
}

function hide_time_start_error() {

    // salvo nella variabile l'elemento dell'errore

    let errorElement = document.getElementById("time_start_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("time_start")

    // Verifico se la lunghezza  è uguale a 5 caratteri
    if (input.value.length === 5) {
        if (count === 1) {
            count--;
            compiledField.classList.add('error_invisible')
        }
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    } else {
        if (count === 0) {
            count++;
            compiledField.classList.remove('error_invisible')
            console.log(count, compiledField, 'non e giusta ')
        }
    }
}

function hide_time_arrived_error() {

    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("time_arrived_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("time_arrived")

    // Verifico se la lunghezza  è uguale a 5 caratteri
    if (input.value.length === 5) {
        if (count === 1) {
            count--;
            compiledField.classList.add('error_invisible')
        }
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    } else {
        if (count === 0) {
            count++;
            compiledField.classList.remove('error_invisible')
            console.log(count, compiledField, 'non e giusta ')
        }
    }
}

function hide_location_error() {
    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("location_error");

    let borderel = document.querySelector('div.tt-search-box-input-container');


    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("location");

    if (input.value.length >= 3) {

        if (count === 1) {
            count--;
            compiledField.classList.add('error_invisible')
            console.log(count, 'deve scomparire')

        }
        console.log(count)

        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        borderel.style.borderColor = "";

        return true;
    } else {
        if (count === 0) {
            console.log(count, 'non deve scomparire')
            count++;
            compiledField.classList.remove('error_invisible')
            console.log(count, compiledField, 'non e giusta ')
        }
    }
}



// salvo nella variabile il bottone di creazioner dell'input
if (document.getElementById("create_step_btn")) {
    const createButton = document.getElementById("create_step_btn")

    // in caso di click del bottone
    createButton.addEventListener('click', function (event) {
        const btnLoading = document.getElementById("btn_loading");
        btnLoading.classList.remove("error_invisible")
        createButton.classList.add("error_invisible")
        // Controllo del nome
        if (!check_name()) {
            event.preventDefault();
            btnLoading.classList.add("error_invisible")
            createButton.classList.remove("error_invisible")
            compiledField.classList.remove("error_invisible")
            count++;
        }

        // Controllo della data
        if (!check_date()) {
            event.preventDefault();
            btnLoading.classList.add("error_invisible")
            createButton.classList.remove("error_invisible")
            compiledField.classList.remove("error_invisible")
            count++;
        }

        // Controllo dell'ora d'inizio
        if (!check_time_start()) {
            event.preventDefault();
            btnLoading.classList.add("error_invisible")
            createButton.classList.remove("error_invisible")
            compiledField.classList.remove("error_invisible")
            count++;
        }

        // Controllo dell'ora di fine
        if (!check_time_arrived()) {
            event.preventDefault();
            btnLoading.classList.add("error_invisible")
            createButton.classList.remove("error_invisible")
            compiledField.classList.remove("error_invisible")
            count++;
        }

        if (!check_location()) {
            event.preventDefault();
            btnLoading.classList.add("error_invisible")
            createButton.classList.remove("error_invisible")
            compiledField.classList.remove("error_invisible")
            count++;
        }

    });
}

if (document.getElementById("edit_step_btn")) {

    // salvo nella variabile il bottone di creazioner dell'input 
    const editButton = document.getElementById("edit_step_btn")

    // in caso di click del bottone
    editButton.addEventListener('click', function (event) {
        const btnLoading = document.getElementById("btn_loading");
        btnLoading.classList.remove("error_invisible")
        createButton.classList.add("error_invisible")
        // Controllo del nome
        if (!check_name()) {
            event.preventDefault();
            btnLoading.classList.add("error_invisible")
            createButton.classList.remove("error_invisible")

        }

        // Controllo della data
        if (!check_date()) {
            event.preventDefault();
            btnLoading.classList.add("error_invisible")
            createButton.classList.remove("error_invisible")

        }

        // Controllo dell'ora d'inizio
        if (!check_time_start()) {
            event.preventDefault();
            btnLoading.classList.add("error_invisible")
            createButton.classList.remove("error_invisible")

        }

        // Controllo dell'ora di fine
        if (!check_time_arrived()) {
            event.preventDefault();
            btnLoading.classList.add("error_invisible")
            createButton.classList.remove("error_invisible")

        }

        if (!check_location()) {
            event.preventDefault();
            btnLoading.classList.add("error_invisible")
            createButton.classList.remove("error_invisible")

        }

    });
}
