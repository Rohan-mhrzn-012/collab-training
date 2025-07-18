import { checkEmpty, checkPattern, checkLength } from './helpers/validationHelper.js';

const registerForm = document.getElementById("register-form");

registerForm.addEventListener("submit", function (e) {
  e.preventDefault(); 

  // for validating the form
  const isValidated = validateForm();
  
  if (isValidated) {
    registerForm.submit();
  }
})

// validates register form before submit
function validateForm() {
  const nameElement = document.getElementById("fullname");
  const emailElement = document.getElementById("email");
  const passwordElement = document.getElementById("password");
  const confirmPasswordElement = document.getElementById("confirm");
  const userElement = document.getElementById("username");
  const genderElement = document.getElementById("gender");
  const agreedElement = document.querySelector("input[name='agree']");

  const gmailRegex = /^[a-z0-9._%+-]+@gmail\.com$/i;

  // validation pass cha first ma bhanera bujney
  let validationPassed = true;

  validationPassed = checkEmpty(nameElement, "Full name is required")
  validationPassed = checkEmpty(userElement, "Username is required")
  validationPassed = checkPattern(emailElement, gmailRegex, "Email pattern should be @gmail.com");
  validationPassed = checkLength(passwordElement, 8, "Password must be at least 8 characters");

  if (passwordElement.value !== confirmPasswordElement.value) {
    const errorSpan = confirmPasswordElement.closest(".form-group").querySelector(".error-section");
    errorSpan.textContent = "Passwords do not match";
    validationPassed = false;
  }
  validationPassed = checkEmpty(genderElement, "Please select your gender");


  if (!agreedElement.checked) {
    const errorSpan = agreedElement.closest(".form-group").querySelector(".error-section");
    errorSpan.textContent = "You must agree to the terms and conditions";
  }

  return validationPassed;
}


// resets error currently displayed on page
function resetErrorDisplayed() {
  const formControls = document.querySelectorAll('.form-control, .checkbox-control');

  formControls.forEach((control) => {
    const clearError = () => {
      const errorSpan = control.closest(".form-group").querySelector(".error-section");
      if (errorSpan) {
        errorSpan.textContent = "";
      }
    };

    control.addEventListener("input", clearError);
    control.addEventListener("change", clearError);
    control.addEventListener("focus", clearError);
  });
}

// on document loaded insert the resetErrorDisplay function for all the form-control
document.addEventListener("DOMContentLoaded", () => {
  resetErrorDisplayed();
});
