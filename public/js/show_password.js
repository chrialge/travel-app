const passwordInputLogin = document.getElementById('password_login');
const visibilityPasswordnLogin = document.getElementById('visibility_password_login');
visibilityPasswordnLogin.addEventListener("click", function (e) {
    e.preventDefault();
    toggleVisibility(passwordInputLogin, visibilityPasswordnLogin);
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
