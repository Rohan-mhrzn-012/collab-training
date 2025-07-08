document.getElementById("my_button").addEventListener("click", function (e) {
  e.preventDefault();

  const name = document.getElementById("fullname").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value;
  const confirm = document.getElementById("confirm").value;
  const gender = document.getElementById("gender").value;
  const agreed = document.querySelector("input[name='agree']").checked;

  const gmailRegex = /^[a-z0-9._%+-]+@gmail\.com$/i;
  const error = [];

  if (name === "") {
    error.push("FullName is required");
  }

  if (!gmailRegex.test(email)) {
    error.push("Email pattern should be @gmail.com");
  }

  if (password.length < 8) {
    error.push(" Password must be at least 8 characters");
  }

  if (password !== confirm) {
    error.push(" Passwords do not match");
  }

  if (gender === "") {
    error.push(" Please select your gender");
  }

  if (!agreed) {
    error.push(" You must agree to the terms and conditions");
  }
  const errors = document.querySelector(".errors");
  console.log(errors);
  const ul = document.createElement("ul");
  error.forEach((err) => {
    const li = document.createElement("li");
    li.textContent = err;
    ul.appendChild(li);


  }


  )
  errors.appendChild(ul);
  alert("Registration successful!");
  document.querySelector("form").reset();
});
