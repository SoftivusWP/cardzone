const form = document.getElementById("form");
const Name = document.getElementById("Name");
const semail = document.getElementById("semail");
const message = document.getElementById("message");
const error = document.getElementsByClassName('error')
const thank = document.querySelector('.thank_you p')
//Error Message
function errorMessage(input, message) {
  const inputElement = input.parentElement;
  inputElement.className = "form-control error";
  const small = inputElement.querySelector("small");
  small.innerText = message;
}
//Success message
function successMessage(input) {
    const inputElement = input.parentElement;
    inputElement.className = "form-control success";
}
//Check Input Elements
function checkInputElement(inputArr) {
  inputArr.forEach(function (input) {
    if (input.value.trim() == "") {
      errorMessage(input, `${inputFieldName(input)} is requerd`);
    } else {
      successMessage(input);
    }
  });
}
//Check Input inputElementNone
function inputElementValueEmpty(inputArr) {
  inputArr.forEach(function (input) {
  input.value = "";

  const inputElement = input.parentElement;
  inputElement.classList.remove("success");
  });
}
//Check length
function checkLength(input, min, max) {
  if (input.value.length < min) {
    errorMessage(
      input,
      `${inputFieldName(input)} must be al least ${min} characters`
    );
  } else if (input.value.length > max) {
    errorMessage(
      input,
      `${inputFieldName(input)} must be less than ${max} characters`
    );
  } else {
    successMessage(input);
  }
}
function checkNumber(input, min, max) {
  if (input.value.length < min) {
    errorMessage(
      input,
      `${inputFieldName(input)} must be al least ${min} characters`
    );
  } else if (input.value.length > max) {
    errorMessage(
      input,
      `${inputFieldName(input)} must be less than ${max} characters`
    );
  } else {
    successMessage(input);
  }
}
//Check semail
function checksemail(semail) {
  const regx =
    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (regx.test(semail.value.trim())) {
    successMessage(semail);
  } else {
    errorMessage(semail, "email is not valid");
  }
}
//Input fields name
function inputFieldName(input) {
  return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}
//add event listener
form.addEventListener("submit", function (e) {
  e.preventDefault();
  checkInputElement([Name,message,semail]);
  checkLength(Name, 3, 25);
  checkLength(message, 10, 10000000);
  checksemail(semail);
  if (error.length === 0) {
    inputElementValueEmpty([Name,message,semail]);
    thank.style.display = "block";
    const myTimeout = setTimeout(()=>{
      thank.style.display = "none";
    }, 2000);
  }
});




