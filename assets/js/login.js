const loginBtn = document.getElementById("login_btn");
const email = document.getElementById("email");
const password = document.getElementById("password");
const email_error = document.getElementById("email_error");

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

email.addEventListener("blur", () => {
  if (!emailRegex.test(email.value)) {
    email_error.innerText = "Enter valid email!";
    return;
  } else {
    email_error.innerText = "";
  }
});

setInterval(() => {
  if (email.value != "" && password.value != "") {
    if (!emailRegex.test(email.value)) return;
    loginBtn.disabled = false;
  }
}, 500);
