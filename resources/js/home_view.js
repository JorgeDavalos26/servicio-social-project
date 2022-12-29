import {env} from "./environment";

window.saveSolicitude = async () => {
    const formId = document.getElementById("solicitude_type_select").value;

    try {
        const res = await postData(`${env.APP_URL}/api/solicitudes`, {formId});

        console.log(res)
        if (res.error == null)
            window.location.href = `${env.APP_URL}/solicitud/${res.data.id}`;
        else
            addToast('danger', res.error, 5);
    } catch (error) {
        console.log(error);
    }
}

window.deleteSolicitude = async (solicitudeId) => {
    try {
        await deleteData(`${env.APP_URL}/api/solicitudes/${solicitudeId}`);
        location.reload();
    } catch (e) {
        console.log(e);
    }
}
