const signupBtn = document.getElementById("signup_btn");
const email = document.getElementById("email");
const password = document.getElementById("password");
const repeatPassword = document.getElementById("repeat-password");
const rp_error = document.getElementById("rp_error");
const email_error = document.getElementById("email_error");
const password_error = document.getElementById("password_error");

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

email.addEventListener("blur", () => {
  if (!emailRegex.test(email.value)) {
    email_error.innerText = "Enter valid email!";
    return;
  } else {
    email_error.innerText = "";
  }
});

password.addEventListener("input", () => {
  if (password.value.length < 8) {
    password_error.innerText = "Password must be at least 8 characters!";
    return;
  } else {
    password_error.innerText = "";
  }
});

repeatPassword.addEventListener("input", () => {
  if (password.value !== repeatPassword.value) {
    rp_error.innerText = "Passwords do not match!";
    signupBtn.disabled = true;
    return;
  } else {
    rp_error.innerText = "";
  }
});

setInterval(() => {
  if (email.value != "" && password.value != "" && repeatPassword.value != "") {
    if (!emailRegex.test(email.value)) return;
    if (password.value.length < 8) return;
    if (password.value !== repeatPassword.value) return;
    signupBtn.disabled = false;
  }
}, 500);
