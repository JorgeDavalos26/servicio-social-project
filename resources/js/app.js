import './bootstrap';
import { env } from "./environment";

// Serie of global CRUD methods to make HTTP requests
window.getData = async function (url = "") {

    const response = await fetch(url);
    return response.json();
}

window.postData = async (url = "", data = {}) => {

    const postData = {
        method: 'POST',
        body: JSON.stringify(data),
        headers: new Headers({
            'Content-Type': 'application/json; charset=UTF-8'
        })
    }
    const response = await fetch(url, postData);
    return response.json();
}

window.putData = async (url = "", data = {}) => {

    const putData = {
        method: 'PUT',
        body: JSON.stringify(data),
        headers: new Headers({
            'Content-Type': 'application/json; charset=UTF-8'
        })
    }
    const response = await fetch(url, putData);
    return response.json();
}

window.deleteData = async (url = "", data = {}) => {

    const deleteData = {
        method: 'DELETE',
        body: JSON.stringify(data),
        headers: new Headers({
            'Content-Type': 'application/json; charset=UTF-8'
        })
    }
    const response = await fetch(url, deleteData);
    return response.json();
}


// Initialize APP_URL global variable
env.APP_URL = app_url;


// To logout from Header navbar
window.logout = () => {

    postData(`${env.APP_URL}/api/auth/logout`)
        .then(res =>
        {
            console.log(res)
            window.location.href=`${env.APP_URL}/inicio`;
        })
        .catch(error => {
            console.log(error);
        });
}


// To import static assets and Vite proccess them correctly
import.meta.glob([
    '../images/**',
    '../fonts/**',
]);


// All about creating and managing alerts
let stackAlerts = [];
let alertsSection = $('#alerts-section').get(0);
let idAlert = 0

let generateAlert = (type, msg, idAlert) => {
    return `
        <div id="alert-${idAlert}" class="alert alert-${type} m-1 p-2 alert-dismissible fade show" role="alert" style="height: auto;">
            <span type="button" class="close-alert-button" data-dismiss="alert" aria-label="Close" onclick="removeAlert(${idAlert})">
                <i class="bi bi-x"></i>
            </span>
            <div style="width:90%">${msg}</div>
        </div>
        `;
}

window.addAlert = (type, msg, duration = 10) =>
{
    let template = generateAlert(type, msg, idAlert);
    stackAlerts.push({type, msg, duration, template, idAlert});
    idAlert++;
}

window.removeAlert = (idAlert) =>
{
    stackAlerts.forEach(e =>
    {
        if(e.idAlert == idAlert) e.duration = 0;
    });
}

let updateAlertsInterval = () =>
{
    stackAlerts = stackAlerts.filter(e => e.duration > 0);
    alertsSection.innerHTML = "";
    stackAlerts.forEach(e =>
    {
        alertsSection.innerHTML += e.template;
        e.duration--;
    });
}

setInterval(updateAlertsInterval, 1000);


// All about creating and managing toasts
let stackToasts = [];
let toastsSection = $('#toasts-section').get(0);
let idToast = 0

let generateToast = (type, msg, idToast) => {
    return `
        <div id="toast-${idToast}" class="alert alert-${type} m-1 p-2 alert-dismissible fade show" role="alert" 
            style="height: auto; pointer-events: auto;">
            <span type="button" class="close-alert-button" data-dismiss="alert" aria-label="Close" onclick="removeToast(${idToast})">
                <i class="bi bi-x"></i>
            </span>
            <div style="width:90%">${msg}</div>
        </div>
        `;
}

window.addToast = (type, msg, duration = 10) =>
{
    let template = generateToast(type, msg, idToast);
    stackToasts.push({type, msg, duration, template, idToast});
    idToast++;
}

window.removeToast = (idToast) =>
{
    stackToasts.forEach(e =>
    {
        if(e.idToast == idToast) e.duration = 0;
    });
}

let updateToastsInterval = () =>
{
    stackToasts = stackToasts.filter(e => e.duration > 0);
    toastsSection.innerHTML = "";
    stackToasts.forEach(e =>
    {
        toastsSection.innerHTML += e.template;
        e.duration--;
    });
}

setInterval(updateToastsInterval, 1000);