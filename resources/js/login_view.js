import { env } from "./environment";

window.login = () => {

    let email = $("#form_login input[name='email']").val();
    let password = $("#form_login input[name='password']").val();

    let data = {
        email,
        password,
    }

    postData(`${env.APP_URL}/api/auth/login`, data)
        .then(res =>
        {
            console.log(res)
            if(res.error == null) window.location.href=`${env.APP_URL}/inicio`;
            else addToast('danger', res.error, 5);
        })
        .catch(error => {
            console.log(error);
        });
}

// Piece of code to detect enter in inputs and proceed to login
let emailInput = $("#form_login input[name='email']").get(0);
let passwordInput = $("#form_login input[name='password']").get(0);

let keypressFunction = (event) =>
{
    if(event.key === "Enter") {
        let loginButton = $("#form_login button[name='login-button']").get(0);
        loginButton.click();
    }
}

emailInput.addEventListener("keypress", keypressFunction);
passwordInput.addEventListener("keypress", keypressFunction);