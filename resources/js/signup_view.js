import { env } from "./environment";

window.signup = () => {

    let username = $("#form_signup input[name='username']").val();
    let email = $("#form_signup input[name='email']").val();
    let password = $("#form_signup input[name='password']").val();
    let password_confirmation = $("#form_signup input[name='password_confirmation']").val();

    if(password_confirmation === "") addToast('warning', 'Favor de confirmar contraseña'); 
    else if(password !== password_confirmation) addToast('warning', 'Contraseñas no coinciden'); 
    else {
        let data = {
            username,
            email,
            password,
        }

        postData(`${env.APP_URL}/api/auth/register`, data)
            .then(res =>
            {
                console.log(res)
                if(res.error == null) window.location.href=`${env.APP_URL}/inicio`;
                else if(res.error === "Email repetido") addToast('danger', "Correo ya esta en uso, registrarse con otro", 5);
                else addToast('danger', res.error, 5);
            })
            .catch(error => {
                console.log(error);
            });
    }
}