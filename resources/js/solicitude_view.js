import {env} from "./environment";

const solicitudeForm = document.getElementById("solicitude_form");

solicitudeForm.addEventListener('submit', async (event) => {
    event.preventDefault();

    const solicitudeId = document.URL.split("/").at(-1);

    try {
        const completeSolicitude = await getData(`${env.APP_URL}/api/solicitudes/complete/${solicitudeId}`);
        
        console.log(completeSolicitude);
    } catch (error) {
        console.log(error);
    }

})
