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
            password_confirmation
        }

        postData(`${env.APP_URL}/api/auth/register`, data)
            .then(res =>
            {
                console.log(res)
                if(res.error == null) window.location.href=`${env.APP_URL}/inicio`;
                else {
                    if (typeof res.error === 'string') {
                        addToast('danger', res.error, 5);
                    }
                    else {
                        const errors = Object.entries(res.error);
                        errors.forEach(error => {
                            error[1].forEach(msg => {
                                if (msg === 'El campo email es requerido.') {
                                    msg = 'Debe ingresar un correo'
                                }
                                else if (msg === 'El campo password es requerido.') {
                                    msg = 'Debe ingresar una contraseña';
                                }
                                else if (msg === 'El campo username es requerido.') {
                                    msg = 'Debe ingresar su nombre completo';
                                }
                                else if (msg === 'El formato del email no es válido.') {
                                    msg = 'Debe ingresar un correo válido';
                                }
                                else if (msg === 'El atributo username no contiene caracteres válidos') {
                                    msg = 'Favor de ingresar un nombre válido';
                                }
                                else if (msg === 'El atributo username es ofensivo') {
                                    msg = 'Favor de ingresar un nombre válido';
                                }
                                else if (msg === 'El campo email ya ha sido tomado.') {
                                    msg = 'Email ya esta en uso, favor de ingresar otro';
                                }
                                else {
                                    msg = '???';
                                }
                                addToast('danger', msg, 5);
                            });
                        });
                    }
                } 
            })
            .catch(error => {
                console.log(error);
            });
    }
}