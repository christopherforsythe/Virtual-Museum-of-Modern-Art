
const isValidEmail = (email) => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
const form = document.getElementById("form");

const thankyoumessage = document.getElementById("thank-you");

const nameInput = document.querySelector(
    'input[name="username"]'
    );

const emailInput = document.querySelector(
    'input[name="email"]'
);


const passwordInput = document.querySelector(
    'input[name="password"]'
);

const inputs = [
    nameInput, emailInput, passwordInput
];

let isFormValid = false;
let isValidationOn = false;

const resetElm = (elm) => {
    elm.classList.remove("invalid");
    elm.nextElementSibling.classList.add("hidden");
}

const invalidateElm = (elm) => {
    elm.classList.add("invalid");
    elm.nextElementSibling.classList.remove("hidden");
}

const validateInputs = () => {

    if(!isValidationOn) return;
    isFormValid = true;
    resetElm(nameInput);
    resetElm(emailInput);
    resetElm(passwordInput);
   

    if (!nameInput.value) {
        isFormValid = false;
        invalidateElm(nameInput);
    }

    if (!isValidEmail(emailInput.value)) {
        isFormValid = false;
        invalidateElm(emailInput);
    }

    if (!passwordInput.value) {
        isFormValid = false;
        invalidateElm(passwordInput);
    }
}

form.addEventListener("submit", (e) => {
    isValidationOn = true;
    validateInputs();
});



inputs.forEach(input =>  {
    input.addEventListener("input", () => {
        validateInputs();
    });
});




