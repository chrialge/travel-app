
const passwordInputLogin = document.getElementById('password_login');
const visibilityPasswordnLogin = document.getElementById('visibility_password_login');

// quando clicco sull'icona
visibilityPasswordnLogin.addEventListener("click", function (e) {
    e.preventDefault();

    // invoco la funzione
    toggleVisibility(passwordInputLogin, visibilityPasswordnLogin);
});


/**
 * funzione che mostra la password
 * @param {Element} password l'elemento input
 * @param {Element} visibility l'icona del input
 */
function toggleVisibility(password, visibility) {

    // se il tipo di input e password
    if (password.type === "password") {

        // cambio il tipo di input
        password.type = "text";

        // tolgo la classe all'icona
        visibility.classList.remove("fa-eye");

        // aggiungo la classe all'icona
        visibility.classList.add("fa-eye-slash");
    } else //altrimenti 
    {
        // cambio il tipo di input
        password.type = "password";

        // tolgo la classe all'icona
        visibility.classList.remove("fa-eye-slash");

        // aggiungo la classe all'icona
        visibility.classList.add("fa-eye");

    }
}
