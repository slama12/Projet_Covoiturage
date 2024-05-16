// Show/hide password onClick of button using Javascript only

// https://stackoverflow.com/questions/31224651/show-hide-password-onclick-of-button-using-javascript-only

function togglePassword(inputId, eyeId) {
    var input = document.getElementById(inputId);
    var eye = document.getElementById(eyeId);
    if (input.type === "password") {
        input.type = "text";
        eye.classList.add('visible');
    } else {
        input.type = "password";
        eye.classList.remove('visible');
    }
}

document.getElementById("eye_new_password").addEventListener("click", function () {
    togglePassword("new_password", "eye");
});

document.getElementById("eye_confirm_password").addEventListener("click", function () {
    togglePassword("confirm_password", "eye");
});

