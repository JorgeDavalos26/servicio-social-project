import {env} from "./environment";

const returnBtn = document.getElementById("return_admin_btn");
returnBtn.addEventListener("click", (event) => {
    event.preventDefault();

    window.location.href = `${env.APP_URL}/inicio`;
});

const confirmPaymentBtn = document.getElementById("confirm_payment_btn");
confirmPaymentBtn.addEventListener('click', (event) => {
    event.preventDefault();


});
