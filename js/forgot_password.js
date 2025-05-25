const emailInput = document.querySelector("#email");
const actionBtn = document.querySelector("#remind_form_send");
const popUp = document.querySelector(".remind__popup");
const popUpCloseBtn = document.querySelector(".register__popup--closeBtn");
const error = document.querySelector(".error");

const closePopUp = () => {
  popUp.style.visibility = "hidden";
  actionBtn.disabled = false;
};

const checkMail = (email) => {
  const re =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  if (re.test(email)) {
    error.style.visibility = "hidden";
    error.textContent = "";
    return true;
  } else {
    error.style.visibility = "visible";
    error.textContent = "Niepoprawny adres email";
    return false;
  }
};

const forgot_password = () => {
  const formData = new FormData();
  formData.append("email", emailInput.value);
  fetch("../php/forgot_password.php", {
    method: "POST",
    body: formData,
  })
    .then(function (response) {
      return response.text();
    })
    .then(function (body) {
      result = body;
      if (result == "success") {
        error.style.visibility = "hidden";
        error.textContent = "";
        popUp.style.visibility = "visible";
        actionBtn.disabled = true;
      } else if (result == "0") {
        error.style.visibility = "visible";
        error.textContent = "Nie istnieje konto z podanym adresem email";
      }
    });
};

popUpCloseBtn.addEventListener("click", closePopUp);

const form = document.querySelector("#login_form")
form.addEventListener("submit", (e) => {
  e.preventDefault();

  if (checkMail(emailInput.value)) {
    forgot_password();
  }});
