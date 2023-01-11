import {env} from "./environment";

const solicitudeForm = document.getElementById("solicitude_form");

// Both functions to get only the elements that matches the description
const delegate = (selector) => (cb) => (e) => e.target.matches(selector) && cb(e);
const fileInputDelegate = delegate('input[type=file]'); // Only inputs of file type

const fileFieldsChanged = []; // Stores the names of the file inputs that have changed

solicitudeForm.addEventListener("change", fileInputDelegate((fileInput) => {
    const index = fileFieldsChanged.indexOf(fileInput.name);

    if (index >= 0) {
        fileFieldsChanged.splice(index, 1);
    }

    fileFieldsChanged.push(fileInput.name);
}));

solicitudeForm.addEventListener('submit', async (event) => {
    event.preventDefault();

});

const saveAnswersButton = document.getElementById("submit_answers");
saveAnswersButton.addEventListener('click', async (event) => {
    await submitSolicitudeForm(false)
});

const toPaymentButton = document.getElementById("proceed_to_payment_btn");
toPaymentButton.addEventListener("click", async (event) => {
    await submitSolicitudeForm(true);
});

const submitSolicitudeForm = async (isSendToPayment) => {
    const solicitudeId = document.URL.split("/").at(-1);

    if (!isSendToPayment) {
        await storeAnswers(solicitudeId);
    } else {
        if (!solicitudeForm.checkValidity()) {
            solicitudeForm.reportValidity();
            return;
        }

        const confirmResult = confirm("¿Seguro que deseas proceder al pago? " +
            "\nSe utilizará el estado actual de tus respuestas y ya no podrás editar tus respuestas.");
        if (!confirmResult) return;

        await storeAnswers(solicitudeId);
        await toPayment(solicitudeId);
    }
}

const storeAnswers = async (solicitudeId) => {
    try {
        const completeSolicitude = await getData(`${env.APP_URL}/api/solicitudes/${solicitudeId}/complete`);
        if (completeSolicitude.status !== 200) {
            addToast("warning", "Ocurrió un problema, por favor intenta de nuevo.");
            return;
        }

        const baseAnswers = getBaseAnswersToSend(solicitudeId, completeSolicitude.data.questions);
        const fileAnswers = getFileAnswersToSend(completeSolicitude.data.questions);

        const storeBulkResponse = await postData(`${env.APP_URL}/api/answers/storeBulk`, baseAnswers);
        if (storeBulkResponse.status !== 200) {
            addToast("warning", "Ocurrió un problema, por favor intenta de nuevo.");
            return;
        }

        for (let i = 0; i < fileAnswers.length; i++) {
            const fileAnswer = fileAnswers[i];

            const formData = new FormData();

            for (let j = 0; j < fileAnswer.files; j++) {
                formData.append(`file${j + 1}`, fileAnswer.files[j]);
            }

            await postData(
                `${env.APP_URL}/api/answers/${solicitudeId}/${fileAnswer.questionId}/updateMediaAnswer`,
                formData,
                "multipart/form-data"
            );
        }

        addToast('success', '¡Solicitud actualizada!', 10);
    } catch (error) {
        addToast("danger", "Estamos encontrando errores, por favor intenta de nuevo más tarde.");
    }
}

const getBaseAnswersToSend = (solicitudeId, questionsFromApi) => {
    const baseAnswersToSend = {
        solicitudeId,
        answers: []
    };

    const formInputs = solicitudeForm.elements;

    for (let i = 0; i < questionsFromApi.length; i++) {
        const question = questionsFromApi[i];

        if (question.type === "file" || question.type === "multiple_file")
            continue;

        let answerValue = '';

        if (question.type === "boolean") {
            const radioGroup = document.querySelector(`input[name=${question.backendName}]:checked`);
            if (!radioGroup) continue;
            answerValue = radioGroup.value;
        } else if (question.type === "select" || question.type === "multiple") {
            const selectedOptions = [];
            for (let option of document.getElementById(question.id).options) {
                if (option.selected) {
                    selectedOptions.push(option.value);
                }
            }
            answerValue = selectedOptions.join('|');
        } else {
            answerValue = formInputs[question.backendName].value;
        }

        // Return only the answers that have changed
        if (question.answer && answerValue === question.answer.value)
            continue;

        baseAnswersToSend.answers.push({
            questionId: question.id,
            answer: answerValue
        });
    }

    return baseAnswersToSend;
}

const getFileAnswersToSend = (questionsFromApi) => {
    const fileAnswerToSend = [];

    for (let i = 0; i < fileFieldsChanged.length; i++) {
        const fileFieldName = fileFieldsChanged[i];

        const field = solicitudeForm.elements[fileFieldName];
        const question = questionsFromApi.find((question) => question.backendName === fileFieldName);

        if (question === undefined) continue;

        fileAnswerToSend.push({
            questionId: question.id,
            files: field.files
        });
    }

    return fileAnswerToSend;
}

const toPayment = async (solicitudeId) => {
    try {
        const toPaymentResponse = await putData(`${env.APP_URL}/api/solicitudes/${solicitudeId}/toPayment`);

        if (toPaymentResponse.status === 400) {
            addToast("warning", "La solicitud no puede ser actualizada en este momento");
            return;
        }

        addToast('success', '¡Solicitud esperando confirmación de pago!', 10);

        saveAnswersButton.disabled = true;
        toPaymentButton.disabled = true;

        const inputs = solicitudeForm.getElementsByTagName("input");
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].disabled = true;
        }

        const selects = solicitudeForm.getElementsByTagName("select");
        for (let i = 0; i < selects.length; i++) {
            selects[i].disabled = true;
        }
    } catch (e) {
        addToast("danger", "Estamos encontrando errores, por favor intenta de nuevo más tarde.");
    }
};

const cancelButton = document.getElementById('cancel_solicitude_btn');
cancelButton.addEventListener('click', async (event) => {
    event.preventDefault();
    window.location.href = `${env.APP_URL}/inicio`;
})
