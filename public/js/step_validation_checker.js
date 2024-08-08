function check_name() {
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("name_error");

    // Prendo l'elemento input per dargli o togliergli stile
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
    let errorElement = document.getElementById("date_error");
    let input = document.getElementById("date");

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
    let errorElement = document.getElementById("time_start_error");
    let input = document.getElementById("time_start");

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
    let errorElement = document.getElementById("time_arrived_error");
    let input = document.getElementById("time_arrived");

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
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("state_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("state");

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

function check_region() {
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("region_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("region");

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

function check_route() {
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("route_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("route");

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

function check_cap() {
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("cap_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("cap");

    let input_checker = parseInt(input.value);
    // Verifico se la lunghezza del nome è di almeno 3 caratteri
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
    let errorElement = document.getElementById("name_error");
    let input = document.getElementById("name");

    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_date_error() {

    let errorElement = document.getElementById("date_error");
    let input = document.getElementById("date")
    console.log(input.value);
    if (input.value.length === 5) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_time_start_error() {

    let errorElement = document.getElementById("time_start_error");
    let input = document.getElementById("time_start")
    console.log(input.value);
    if (input.value.length === 5) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_time_arrived_error() {

    let errorElement = document.getElementById("time_arrived_error");
    let input = document.getElementById("time_arrived")
    console.log(input.value);
    if (input.value.length === 5) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_state_error() {
    let errorElement = document.getElementById("state_error");
    let input = document.getElementById("state");

    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_region_error() {
    let errorElement = document.getElementById("region_error");
    let input = document.getElementById("region");

    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_route_error() {
    let errorElement = document.getElementById("route_error");
    let input = document.getElementById("route");

    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}

function hide_cap_error() {
    let errorElement = document.getElementById("cap_error");
    let input = document.getElementById("cap");
    let input_checker = parseInt(input.value);
    if (Number.isInteger(input_checker)) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";
    }
}


const createButton = document.getElementById("create_step_btn")
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


const editButton = document.getElementById("edit_step_btn")
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