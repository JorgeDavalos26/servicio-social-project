import { env } from "./environment";

const solicitudeForm = document.getElementById("solicitude_form");

solicitudeForm.addEventListener('submit', (event) => {
    event.preventDefault();
    console.log("Form submitted");
})
