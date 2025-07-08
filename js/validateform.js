document.getElementById("my_button").addEventListener("click", function (e) {
  e.preventDefault();

  const name = document.getElementById("fullname").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value;
  const confirm = document.getElementById("confirm").value;
  const gender = document.getElementById("gender").value;
  const agreed = document.querySelector("input[name='agree']").checked;

  const gmailRegex = /^[a-z0-9._%+-]+@gmail\.com$/i;

  if (name === "") {
    alert(" Full Name is required");
    return;
  }

  if (!gmailRegex.test(email)) {
    alert(" Please enter a valid Gmail address");
    return;
  }

  if (password.length < 8) {
    alert(" Password must be at least 6 characters");
    return;
  }

  if (password !== confirm) {
    alert(" Passwords do not match");
    return;
  }

  if (gender === "") {
    alert(" Please select your gender");
    return;
  }

  if (!agreed) {
    alert(" You must agree to the terms and conditions");
    return;
  }

  alert("Registration successful!");
  document.querySelector("form").reset(); 
});
