const form = document.getElementById("createUserForm");
const submitBtn = document.getElementById("submitBtn");

form.addEventListener("submit", function (event) {
  if (!form.checkValidity()) {
    event.preventDefault();
    event.stopPropagation();
  } else {
    submitBtn.classList.add("btn-loading");
  }
  form.classList.add("was-validated");
});

function togglePassword() {
  const passwordInput = document.getElementById("senha");
  const icon = document.querySelector(".password-toggle i");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    passwordInput.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
}

const emailInput = document.getElementById("email");
emailInput.addEventListener("input", function () {
  if (emailInput.validity.valid) {
    emailInput.classList.remove("is-invalid");
    emailInput.classList.add("is-valid");
  } else {
    emailInput.classList.remove("is-valid");
    emailInput.classList.add("is-invalid");
  }
});
