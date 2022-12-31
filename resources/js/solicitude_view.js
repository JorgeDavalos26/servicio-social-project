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

    const solicitudeId = document.URL.split("/").at(-1);

    try {
        const completeSolicitude = await getData(`${env.APP_URL}/api/solicitudes/${solicitudeId}/complete`);

        const baseAnswers = getBaseAnswersToSend(solicitudeId, completeSolicitude.data.questions);
        const fileAnswers = getFileAnswersToSend(completeSolicitude.data.questions);

        await postData(`${env.APP_URL}/api/answers/storeBulk`, baseAnswers);

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

        addAlert('success', 'Solicitud actualizada!', 10);

        //window.location.href=`${env.APP_URL}/inicio`;

    } catch (error) {
        console.log(error);
    }

});

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
