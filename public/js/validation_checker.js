// name
function check_name() {
    // salvo in una variabile l'elemento dell'errore
    let errorElement = document.getElementById("name_error");

    // salvo in una variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("name");

    // Verifico se la lunghezza del nome è di almeno 3 caratteri e non oltre i 255 caratteri
    if (input.value.length >= 3 && input.value.length <= 255) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_name").style.borderBottom = "";

        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        document.getElementById("input_group_name").style.borderBottom = "3px solid red";

        return false;
    }
}

// lastname
function check_lastname() {
    // salvo in una variabile l'elemento dell'errore
    let errorElement = document.getElementById("lastname_error");

    // salvo in una variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("lastname");

    // Verifico se la lunghezza del nome è di almeno 3 caratteri e non oltre i 255 caratteri
    if (input.value.length >= 3 && input.value.length <= 255) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_lastname").style.borderBottom = "";

        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        document.getElementById("input_group_lastname").style.borderBottom = "3px solid red";

        return false;
    }
}

//mail
function check_email() {
    // salvo in una variabile l'elemento dell'errore
    let errorElement = document.getElementById("email_error");

    // salvo in una variabile l'elemento input per dargli o togliergli stile
    let input = document.getElementById("email");

    // Verifico se la lunghezza dell'email è di almeno 3 caratteri e contiene una chiocciola (@)
    if (input.value.length >= 3 && input.value.length <= 255 && input.value.includes('@')) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_email").style.borderBottom = "";

        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        document.getElementById("input_group_email").style.borderBottom = "3px solid red";

        return false;
    }
}

//psw checker
let check_pw = function check_pw() {
    // salvo in una variabile l'elemento dell'errore
    let errorElement = document.getElementById("password_error");

    // salvo in una variabile l'elemento confirm password per dargli o togliergli stile
    let input = document.getElementById("password-confirm");

    // salvo in una variabile l'elemento password per verificare se è vuoto
    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('password-confirm').value;

    // Verifico se la password non è vuota e se le password coincidono
    if (confirmPassword === "") {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_password_confirm").style.borderBottom = "";
        return true;
    } else if (password !== "" && password === confirmPassword) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_password_confirm").style.borderBottom = "";
        return true;
    } else {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        document.getElementById("input_group_password_confirm").style.borderBottom = "3px solid red";
        return false;
    }
};

// 2 FUNZIONE NASCONDI ERRORE

// Funzione per nascondere l'errore del nome
function hide_name_error() {
    // salvo in una variabile l'elemento dell'errore
    let errorElement = document.getElementById("name_error");

    // salvo in una variabile l'elemento confirm password per dargli o togliergli stile
    let input = document.getElementById("name");

    // Verifico se la lunghezza del nome è di almeno 3 caratteri e non oltre i 255 caratteri
    if (input.value.length >= 3 && input.value.length <= 255) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_name").style.borderBottom = "";
    }
}

// Funzione per nascondere l'errore del cognome
function hide_lastname_error() {
    // salvo in una variabile l'elemento dell'errore
    let errorElement = document.getElementById("lastname_error");

    // salvo in una variabile l'elemento confirm password per dargli o togliergli stile
    let input = document.getElementById("lastname");

    // Verifico se la lunghezza del nome è di almeno 3 caratteri e non oltre i 255 caratteri
    if (input.value.length >= 3 && input.value.length <= 255) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_lastname").style.borderBottom = "";

    }
}

// Funzione per nascondere l'errore dell'email
function hide_email_error() {
    // salvo in una variabile l'elemento dell'errore
    let errorElement = document.getElementById("email_error");

    // salvo in una variabile l'elemento confirm password per dargli o togliergli stile
    let input = document.getElementById("email");

    // Verifico se la lunghezza del nome è di almeno 3 caratteri e non oltre i 255 caratteri e con la chioccola
    if (input.value.length >= 3 && input.value.length <= 255 && input.value.includes('@')) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_email").style.borderBottom = "";

    }
}

// Funzione per nascondere l'errore della password
function hide_password_error() {
    // salvo in una variabile l'elemento dell'errore
    let errorElement = document.getElementById("password_error");


    // salvo in una variabile il valore di password
    let password = document.getElementById('password').value;

    // salvo in una variabile il valore di password-confirm
    let confirmPassword = document.getElementById('password-confirm').value;

    // Verifico che non sia vuota e che la password sia uguale a quellad i conferma
    if (password !== "" && password === confirmPassword) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_password_confirm").style.borderBottom = "";

    }
}

// salvo il bottone di registrazione
let registerButton = document.getElementById('register-submit-button')

//Verifico che tutti i checker vadano bene
registerButton.addEventListener('click', function (event) {

    // Controllo del nome
    if (!check_name()) {
        event.preventDefault();
    }

    // Controllo del cognome
    if (!check_lastname()) {
        event.preventDefault();
    }

    // Controllo dell'email
    if (!check_email()) {
        event.preventDefault();
    }

    // Controllo della password
    let password = document.getElementById('password').value;

    // salvo in una variabile l'elemento confirm password per dargli o togliergli stile
    let confirmPassword = document.getElementById('password-confirm').value;

    // salvo in una variabile il valore di password
    let errorElement = document.getElementById("password_error");


    // Verifico se la passoword e vuota o uguale alla password di conferma o la password id conferma e vuota
    if (password === "" || confirmPassword === "" || password !== confirmPassword) {
        errorElement.classList.remove("error_invisible");
        errorElement.classList.add("error_visible");
        document.getElementById("input_group_password_confirm").style.borderBottom = "3px solid red";

        event.preventDefault();
    } else {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_password_confirm").style.borderBottom = "";

    }
});


//Rendere visibile la password

// salvo nella variabile l'icona
const visibilityBtn = document.getElementById('visibilityBtn');

// salvo nella variabile l'input della password
const passwordInput = document.getElementById('password');

// se clicco sull'icona
visibilityBtn.addEventListener("click", function (e) {

    // prevengo il comportamento di default
    e.preventDefault();

    // invoco la funzione
    toggleVisibility(passwordInput, visibilityBtn);
});

// salvo nella variabile l'input della password di conferma
const passwordInputConfirm = document.getElementById('password-confirm');

// salvo nella variabile l'icona
const visibilityBtn_confirm = document.getElementById('visibilityBtn_confirm')

// se clicco sull'icona
visibilityBtn_confirm.addEventListener("click", function (e) {

    // prevengo il comportamento di default
    e.preventDefault();

    // invoco la funzione
    toggleVisibility(passwordInputConfirm, visibilityBtn_confirm);
});

/**
 * funzione che mostra la password
 * @param {Element} password e l'input
 * @param {Element} visibility e l'icona
 */
function toggleVisibility(password, visibility) {

    // Se l'input e di tipo password
    if (password.type === "password") {

        // mostra la password
        password.type = "text";

        //rimuove la classe dell'icona
        visibility.classList.remove("fa-eye");

        // aggiunge la classe all'icona
        visibility.classList.add("fa-eye-slash");
    } else //altrimenti
    {

        // nasconde la password
        password.type = "password";

        //rimuove la classe dell'icona
        visibility.classList.add("fa-eye");

        // aggiunge la classe all'icona
        visibility.classList.remove("fa-eye-slash");
    }
}
