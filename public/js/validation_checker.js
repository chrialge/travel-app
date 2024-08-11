// name
function check_name() {
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("name_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("name");

    // Verifico se la lunghezza del nome è di almeno 8 caratteri
    if (input.value.length >= 3) {
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
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("lastname_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("lastname");

    // Verifico se la lunghezza del nome è di almeno 8 caratteri
    if (input.value.length >= 3) {
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
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("email_error");

    // Prendo l'elemento input per dargli o togliergli stile
    let input = document.getElementById("email");

    // Verifico se la lunghezza dell'email è di almeno 3 caratteri e contiene una chiocciola (@)
    if (input.value.length >= 3 && input.value.includes('@')) {
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
    // Prendo l'elemento dell'errore
    let errorElement = document.getElementById("password_error");

    // Prendo l'elemento confirm password per dargli o togliergli stile
    let input = document.getElementById("password-confirm");

    // Prendo l'elemento password per verificare se è vuoto
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
    let errorElement = document.getElementById("name_error");
    let input = document.getElementById("name");

    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_name").style.borderBottom = "";
    }
}

// Funzione per nascondere l'errore del cognome
function hide_lastname_error() {
    let errorElement = document.getElementById("lastname_error");
    let input = document.getElementById("lastname");

    if (input.value.length >= 3) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_lastname").style.borderBottom = "";

    }
}

// Funzione per nascondere l'errore dell'email
function hide_email_error() {
    let errorElement = document.getElementById("email_error");
    let input = document.getElementById("email");

    if (input.value.length >= 3 && input.value.includes('@')) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_email").style.borderBottom = "";

    }
}

// Funzione per nascondere l'errore della password
function hide_password_error() {
    let errorElement = document.getElementById("password_error");
    let input = document.getElementById("password-confirm");
    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('password-confirm').value;

    if (password !== "" && password === confirmPassword) {
        errorElement.classList.remove("error_visible");
        errorElement.classList.add("error_invisible");
        document.getElementById("input_group_password_confirm").style.borderBottom = "";

    }
}


let registerButton = document.getElementById('register-submit-button')
let buttonValue = false;
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
    let confirmPassword = document.getElementById('password-confirm').value;
    let errorElement = document.getElementById("password_error");
    let input = document.getElementById("password-confirm");

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
const visibilityBtn = document.getElementById('visibilityBtn');
const passwordInput = document.getElementById('password');
visibilityBtn.addEventListener("click", function (e) {
    e.preventDefault();
    toggleVisibility(passwordInput, visibilityBtn);
});

const passwordInputConfirm = document.getElementById('password-confirm');
const visibilityBtn_confirm = document.getElementById('visibilityBtn_confirm')
visibilityBtn_confirm.addEventListener("click", function (e) {
    e.preventDefault();
    toggleVisibility(passwordInputConfirm, visibilityBtn_confirm);
});


function toggleVisibility(password, visibility) {
    console.log('ciao', password)
    if (password.type === "password") {
        password.type = "text";
        visibility.classList.remove("fa-eye");
        visibility.classList.add("fa-eye-slash");
    } else {
        password.type = "password";
        visibility.classList.add("fa-eye");
        visibility.classList.remove("fa-eye-slash");
    }
}
