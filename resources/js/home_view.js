import { env } from "./environment";

window.saveSolicitude = () => {
    const formId = document.getElementById("form_select").value;

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
