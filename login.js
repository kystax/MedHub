document.addEventListener("DOMContentLoaded", function() {
const sign_in_btn = document.querySelector("#sign-in-btn")
const sign_up_btn = document.querySelector("#sign-up-btn")
const container = document.querySelector(".container")

sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
  });
  
  sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
  });

  const signUpForm = document.getElementById("sign-up-form");
  const signInForm = document.getElementById("sign-in-form");

  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  signUpForm.addEventListener("submit", function(event) {
    const username = document.getElementById("sign-up-username").value;
    const email = document.getElementById("sign-up-email").value;
    const password = document.getElementById("sign-up-password").value;

    let isValid = true;
    let errorMessage = '';

    if (username === "" || email === "" || password === "") {
      isValid = false;
      errorMessage = "All fields are required.";
    } else if (!emailPattern.test(email)) {
      isValid = false;
      errorMessage = "Please enter a valid email address.";
    } else if (password.length < 6) {
      isValid = false;
      errorMessage = "Password must be at least 6 characters long.";
    }

    if (!isValid) {
      alert(errorMessage);
      event.preventDefault();
    }
  });

  signInForm.addEventListener("submit", function(event) {
    const username = document.getElementById("sign-in-username").value;
    const password = document.getElementById("sign-in-password").value;

    let isValid = true;
    let errorMessage = '';

    if (username === "" || password === "") {
      isValid = false;
      errorMessage = "All fields are required.";
    } else if (password.length < 6) {
      isValid = false;
      errorMessage = "Password must be at least 6 characters long.";
    }

    if (!isValid) {
      alert(errorMessage);
      event.preventDefault();
    }
  });
});  
  