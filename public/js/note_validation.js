// name
function check_name() {
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("name_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("customer_name");

    // Verifico se la lunghezza del nome è di almeno 3 caratteri
    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.borderBottom = "";

        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        input.style.border = "1px solid red";

        return false;
    }
}

// lastname
function check_lastname() {
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("lastname_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("customer_lastname");

    // Verifico se la lunghezza del cognome è di almeno 3 caratteri
    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.border = "";
        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        input.style.border = "1px solid red";
        return false;
    }
}

//mail
function check_email() {
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("email_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("customer_email");

    // Verifico se la lunghezza dell'email è di almeno 3 caratteri e contiene una chiocciola (@)
    if (input.value.length >= 3 && input.value.includes('@')) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.border = "";

        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        input.style.border = "1px solid red";

        return false;
    }
}

//mail
function check_note() {
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("note_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("note");

    // Verifico se la lunghezza della nota e di almeno 6 caratteri
    if (input.value.length >= 6) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.border = "";
        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        input.style.border = "1px solid red";
        return false;
    }
}


// 2 FUNZIONE NASCONDI ERRORE

// Funzione per nascondere l'errore del nome
function hide_name_error() {
    let errorElement = document.getElementById("name_error");
    let input = document.getElementById("customer_name");

    // Verifico se la lunghezza del nome è di almeno 3 caratteri
    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.border = "";
    }
}

// Funzione per nascondere l'errore del cognome
function hide_lastname_error() {
    let errorElement = document.getElementById("lastname_error");
    let input = document.getElementById("customer_lastname");

    // Verifico se la lunghezza del cognome è di almeno 3 caratteri\
    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.border = "";

    }
}

// Funzione per nascondere l'errore dell'email
function hide_email_error() {
    let errorElement = document.getElementById("email_error");
    let input = document.getElementById("customer_email");

    // Verifico se la lunghezza dell'email è di almeno 3 caratteri e contiene una chiocciola (@)
    if (input.value.length >= 3 && input.value.includes('@')) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.border = "";

    }
}

// Funzione per nascondere l'errore dell'email
function hide_note_error() {
    let errorElement = document.getElementById("note_error");
    let input = document.getElementById("note");

    // Verifico se la lunghezza della note è di almeno 6 caratteri
    if (input.value.length >= 6) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        input.style.border = "";

    }
}

let createButton = document.getElementById('create_note_btn')
//Verifico che tutti i checker vadano bene
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
    if (!check_lastname()) {
        event.preventDefault();
        btnLoading.classList.add("error_invisible")
        createButton.classList.remove("error_invisible")
    }

    // Controllo dell'email
    if (!check_email()) {
        event.preventDefault();
        btnLoading.classList.add("error_invisible")
        createButton.classList.remove("error_invisible")
    }

    // Controllo della nota
    if (!check_note()) {
        event.preventDefault();
        btnLoading.classList.add("error_invisible")
        createButton.classList.remove("error_invisible")
    }
});