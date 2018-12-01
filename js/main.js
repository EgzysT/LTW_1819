'use strict';

/* Signup page functions */
let signupForm = document.querySelector('#signup-form');
if (signupForm) { // Handle password confirmation.
    let passwordField = signupForm.querySelector('input[name="password"]');
    let confirmPasswordField = signupForm.querySelector('input[name="confirm_password"]');

    let validatePassword = () => {
        if(passwordField.value !== confirmPasswordField.value) // Passwords don't match.
            return 1;
        else if(passwordField.value.length < 5) // Password doesn't have atleast 5 characters.
            return 2;
        else return 0; // All OK
    }
    signupForm.onsubmit = (e) => {
        if(validatePassword() !== 0)
            e.preventDefault();
    }

    let updateValidity = () => {
        if(validatePassword() == 0)
            confirmPasswordField.setCustomValidity('');
        else if(validatePassword() == 1){
            confirmPasswordField.setCustomValidity('Passwords don\'t match.');
        }
        else if(validatePassword() == 2){
            confirmPasswordField.setCustomValidity('Password must have atleast 5 characters.');
        }
        signupForm.reportValidity();
    }
    confirmPasswordField.onkeyup = updateValidity;
}