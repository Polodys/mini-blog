/**
 * Script to handle password validation and validation when submitting a form
 */
document.addEventListener('DOMContentLoaded', function() {
    passwordValidation();
    formSubmissionValidation();
});

/**
 * Validates password in real time, according to the defined pattern.
 * Displays a dynamic help message to inform the user whether the password is valid or not.
 */
function passwordValidation() {
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[&_\+\-\*\/\$£%@#!:;,?])[A-Za-z\d&_\+\-\*\/\$£%@#!:;,?]{8,25}$/;
        const passwordHelpBlock = document.getElementById('passwordHelpBlock');

        if (!passwordPattern.test(password)) {
            passwordHelpBlock.textContent = "Votre mot de passe doit contenir entre 8 et 25 caractères, avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial parmi ceux autorisés (& _ + - * / $ £ % @ # ! : ; , ?).";
            passwordHelpBlock.classList.add('text-danger');
        } else {
            passwordHelpBlock.textContent = "Mot de passe valide.";
            passwordHelpBlock.classList.remove('text-danger');
            passwordHelpBlock.classList.add('text-success');
        }
    })
};

/**
 * Validates the form submission.
 * If the password doesn't follow the defined pattern, prevents form submission and displays
 * a modal alert.
 */
function formSubmissionValidation() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        const passwordField = document.getElementById('password');
        const password = passwordField.value;
        const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[&_\+\-\*\/\$£%@#!:;,?])[A-Za-z\d&_\+\-\*\/\$£%@#!:;,?]{8,25}$/;

        if (!passwordPattern.test(password)) {
            event.preventDefault(); // Prevents form submission

            // Display the modal alert
            const invalidPasswordModal = new bootstrap.Modal(document.getElementById('invalidPasswordModal'));
            invalidPasswordModal.show();

            // Focus on password field when modal alert is closed
            invalidPasswordModal._element.addEventListener('hidden.bs.modal', function () {
                passwordField.focus();
            });
        }
    });
}