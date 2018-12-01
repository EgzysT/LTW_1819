'use strict';

/* Signup page functions */
let signupForm = document.querySelector('#signup-form');
if (signupForm) { // Handle password confirmation.
    let passwordField = signupForm.querySelector('input[name="password"]');
    let confirmPasswordField = signupForm.querySelector('input[name="confirm_password"]');
    let submitButton = signupForm.querySelector('input[type="submit"]');

    let validatePassword = () => {
        if(passwordField.value !== confirmPasswordField.value)
            return false;
        else
            return true;
    }
    signupForm.onsubmit = (e) => {
        if(!validatePassword())
            e.preventDefault();
    }

    let updateValidity = () => {
        if(validatePassword())
            confirmPasswordField.setCustomValidity('');
        else {
            confirmPasswordField.setCustomValidity('Passwords don\'t match.');
        }
        signupForm.reportValidity();
    }
    confirmPasswordField.onkeyup = updateValidity;
}