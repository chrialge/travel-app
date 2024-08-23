function check_name() {
    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("name_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("name");

    // Verifico se la lunghezza del nome è di almeno 3 caratteri
    if (input.value.length >= 3 || input.value.length >= 50) {
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

function check_state() {
    // salva in una variabile l'elemento dell'errore
    let errorElement = document.getElementById("state_error");

    // salva in una variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("state");

    // Verifico se la lunghezza dello stato è di almeno 3 caratteri
    if (input.value.length >= 3 || input.value.length >= 50) {
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

function check_region() {
    // salva in una variabile l'elemento dell'errore
    let errorElement = document.getElementById("region_error");

    // salva in una variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("region");

    // Verifico se la lunghezza della regione è di almeno 3 caratteri
    if (input.value.length >= 3 || input.value.length >= 50) {
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

function check_route() {
    // salva in una variabile l'elemento dell'errore
    let errorElement = document.getElementById("route_error");

    // salva in una variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("route");

    // Verifico se la lunghezza della via è di almeno 3 caratteri
    if (input.value.length >= 3 || input.value.length >= 50) {
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

function check_cap() {
    // salva in una variabile l'elemento dell'errore
    let errorElement = document.getElementById("cap_error");

    // salva in una variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("cap");

    let input_checker = parseInt(input.value);
    // Verifico se il cap e un numero intero
    console.log(input_checker)
    if (Number.isInteger(input_checker)) {
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

function hide_name_error() {
    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("name_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("name");

    // Verifico se la lunghezza del nome è di almeno 3 caratteri
    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_date_error() {
    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("date_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("date")

    // Verifico se la lunghezza  è uguale a 10 caratteri
    if (input.value.length === 10) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_time_start_error() {

    // salvo nella variabile l'elemento dell'errore

    let errorElement = document.getElementById("time_start_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("time_start")

    // Verifico se la lunghezza  è uguale a 5 caratteri
    if (input.value.length === 5) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_time_arrived_error() {

    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("time_arrived_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("time_arrived")

    // Verifico se la lunghezza  è uguale a 5 caratteri
    if (input.value.length === 5) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_state_error() {

    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("state_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("state");

    // Verifico se il valore e maggiore di o uguale a tre
    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_region_error() {

    // salvo nella variabile l'elemento dell'errore

    let errorElement = document.getElementById("region_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile

    let input = document.getElementById("region");

    // Verifico se il valore e maggiore di o uguale a tre
    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_route_error() {

    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("route_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile

    let input = document.getElementById("route");

    // Verifico se il valore e maggiore di o uguale a tre
    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_cap_error() {

    // salvo nella variabile l'elemento dell'errore
    let errorElement = document.getElementById("cap_error");

    // salvo nella variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("cap");

    // salvo nella variabile il valore intero dell'input
    let input_checker = parseInt(input.value);

    // Verifico se e un numero positivo
    if (Number.isInteger(input_checker)) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}


// salvo nella variabile il bottone di creazioner dell'input
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

    // Controllo lo stato
    if (!check_state()) {
        event.preventDefault();
        btnLoading.classList.add("error_invisible")
        createButton.classList.remove("error_invisible")
    }
    // Controllo della regione
    if (!check_region()) {
        event.preventDefault();
        btnLoading.classList.add("error_invisible")
        createButton.classList.remove("error_invisible")
    }

    // Controllo della via 
    if (!check_route()) {
        event.preventDefault();
        btnLoading.classList.add("error_invisible")
        createButton.classList.remove("error_invisible")
    }

    // Controllo del cap
    if (!check_cap()) {
        event.preventDefault();
        btnLoading.classList.add("error_invisible")
        createButton.classList.remove("error_invisible")
    }
});

// salvo nella variabile il bottone di creazioner dell'input 
const editButton = document.getElementById("edit_step_btn")

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

    // Controllo lo stato
    if (!check_state()) {
        event.preventDefault();
        btnLoading.classList.add("error_invisible")
        createButton.classList.remove("error_invisible")
    }
    // Controllo lo stato
    if (!check_region()) {
        event.preventDefault();
        btnLoading.classList.add("error_invisible")
        createButton.classList.remove("error_invisible")
    }

    // Controllo lo stato
    if (!check_route()) {
        event.preventDefault();
        btnLoading.classList.add("error_invisible")
        createButton.classList.remove("error_invisible")
    }

    // Controllo lo stato
    if (!check_state()) {
        event.preventDefault();
        btnLoading.classList.add("error_invisible")
        createButton.classList.remove("error_invisible")
    }

    // Controllo lo stato
    if (!check_cap()) {
        event.preventDefault();
        btnLoading.classList.add("error_invisible")
        createButton.classList.remove("error_invisible")
    }
});