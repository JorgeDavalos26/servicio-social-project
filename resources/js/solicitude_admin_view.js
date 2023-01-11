import {env} from "./environment";

const returnBtn = document.getElementById("return_admin_btn");
returnBtn.addEventListener("click", (event) => {
    event.preventDefault();

    window.location.href = `${env.APP_URL}/inicio`;
});

const confirmPaymentBtn = document.getElementById("confirm_payment_btn");
confirmPaymentBtn.addEventListener('click', async (event) => {
    event.preventDefault();
    const solicitudeId = document.URL.split("/").at(-1);

    const confirmResult = confirm("¿Seguro que desea confirmar el pago?");
    if (!confirmResult) return;

    try {
        const confirmPaymentResponse = await putData(`${env.APP_URL}/api/solicitudes/${solicitudeId}/confirmPayment`);

        if (confirmPaymentResponse.status === 200) {
            addAlert('success', '¡Pago confirmado!', 10);
            window.location.href = `${env.APP_URL}/inicio`;
        } else if (confirmPaymentResponse.status === 400) {
            addAlert('warning', '¡Solicitud no apta para confirmación de pago!', 10);
        }
    } catch (e) {
        addAlert("danger", "Hubo un error interno, por favor intenta nuevamente.");
    }

});
