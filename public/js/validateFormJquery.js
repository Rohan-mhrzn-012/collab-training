import { checkEmpty, checkPattern, checkLength } from './helpers/validationHelper.js';

$(document).ready(function () {
  const $form = $("#register-form");

  $form.on("submit", function (e) {
    e.preventDefault();

    const isValidated = validateForm();

    if (isValidated) {
      this.submit();
    }
  });

  resetErrorDisplayed();
});

function validateForm() {
  const $name = $("#fullname");
  const $email = $("#email");
  const $password = $("#password");
  const $confirmPassword = $("#confirm");
  const $username = $("#username");
  const $gender = $("#gender");
  const $agree = $("input[name='agree']");

  const gmailRegex = /^[a-z0-9._%+-]+@gmail\.com$/i;
  let validationPassed = true;

  validationPassed = checkEmpty($name[0], "Full name is required") && validationPassed;
  validationPassed = checkEmpty($username[0], "Username is required") && validationPassed;
  validationPassed = checkPattern($email[0], gmailRegex, "Email pattern should be @gmail.com") && validationPassed;
  validationPassed = checkLength($password[0], 8, "Password must be at least 8 characters") && validationPassed;

  if ($password.val() !== $confirmPassword.val()) {
    const $errorSpan = $confirmPassword.closest(".form-group").find(".error-section");
    $errorSpan.text("Passwords do not match");
    validationPassed = false;
  }

  validationPassed = checkEmpty($gender[0], "Please select your gender") && validationPassed;

  if (!$agree.prop("checked")) {
    const $errorSpan = $agree.closest(".form-group").find(".error-section");
    $errorSpan.text("You must agree to the terms and conditions");
    validationPassed = false;
  }

  return validationPassed;
}

function resetErrorDisplayed() {
  $(".form-control, .checkbox-control").on("input change focus", function () {
    const $errorSpan = $(this).closest(".form-group").find(".error-section");
    $errorSpan.text("");
  });
}