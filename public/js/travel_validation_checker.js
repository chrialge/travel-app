function check_name() {
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("name_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("name");

    // Verifico se la lunghezza del nome è di almeno 3 caratteri e non oltre i 100 caratteri
    if (input.value.length >= 3 && input.value.length <= 100) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.border = "";

        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        input.style.border = "2px solid red";

        return false;
    }
}

function check_date_range() {

    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("date_range_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("date_range");

    // Verifico se la lunghezza della data è di 24 caratteri
    if (input.value.length === 24) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderColor = "";

        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        input.style.border = "2px solid red";

        return false;
    }
}


// Funzione per nascondere l'errore del nome
function hide_name_error() {
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("name_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("name");

    // Verifico se la lunghezza del nome è di almeno 3 caratteri e non oltre i 100 caratteri
    if (input.value.length >= 3 && input.value.length <= 100) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.border = "";
    }
}

function hide_date_range_error() {
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("date_range_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("date_range")

    // Verifico se la lunghezza del nome è di almeno 24 caratteri
    if (input.value.length === 24) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.border = "";
    }
}



// Salvo in una variabile il bottone di creazione e modifica del viaggio
const createButton = document.getElementById("travel_btn")

// se clicco sul bottone
if (createButton) {
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

        // Controllo del cognome
        if (!check_date_range()) {
            event.preventDefault();
            btnLoading.classList.add("error_invisible")
            createButton.classList.remove("error_invisible")
        }
    });
}



