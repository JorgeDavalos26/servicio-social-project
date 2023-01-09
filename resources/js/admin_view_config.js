import { env } from "./environment";

function isPositiveInteger(str) {
    try {
        if (typeof str !== "string") {
            return false;
        }
        const num = Number(str);
        if (Number.isInteger(num) && num > 0) {
            return true;
        }
        return false;
    } catch (error) {
        console.log(error);
        return false;
    }
}

function parseDatepickerDate(string) {
    const splitString = string.split(/\D/);
    return splitString.reverse().join("-");
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function formatSetting(string) {
    return string.split(".")[1].replace("_", " ").toLowerCase();
}
function convertWordsToAccentWords(string) {
    const str = string.split(" ");
    const words = {
        tecnologo: "tecnólogo",
        ingenieria: "ingeniería",
        nivelacion: "nivelación",
        propedeutico: "propedéutico",
    };
    return str
        .map((word) => {
            if (words[word]) return words[word];
            return word;
        })
        .join(",")
        .replace(",", " ");
}

async function handleUpdatePeriod(periodId, label) {
    const url = `${env.APP_URL}/api/periods/${periodId}`;
    const res = await putData(url, { label });
    if (res.status == 200) {
        return;
    }
    addToast("danger", res.error, 5);
}

async function handleUpdateSetting(key, value) {
    const url = `${env.APP_URL}/api/settings/${key}`;
    const res = await putData(url, { value });
    if (res.status == 200) {
        return;
    }
    addToast("danger", res.error, 5);
}

async function handleChangeUpcoming(value, key) {
    const url = `${env.APP_URL}/api/settings/updateReceiveUpcomingSolicitudes`;
    const data = [];
    data.push({
        key,
        value,
    });
    const res = await putData(url, { input: data });
    if (res.status == 200) {
        return;
    }
    addToast("danger", res.error, 5);
}

async function handleCreatePeriod(data) {
    const url = `${env.APP_URL}/api/periods`;
    const res = await postData(url, data);
    if (res.status == 200) {
        return res.data;
    }
    addToast("danger", res.error, 5);
}

async function renderCheckSection(id, key, value) {
    const checkDiv = $(`#check-${id}`);

    checkDiv.append(
        `
        <div class="p-2">
        <label>
            <input type="checkbox" 
            name="checkbox-${id}" 
            id="checkbox-${id}" ${value == 1 ? "checked" : ""}/>
            Recibir solicitudes 
        </label>
        </div>`
    );
    checkDiv.click((e) => {
        const checkbox = $(`#checkbox-${id}`);
        const isChecked = checkbox.is(":checked");
        handleChangeUpcoming(isChecked, key);
    });
}

async function renderPeriod(id, activePeriod) {
    const periodDiv = $(`#period-${id}`);
    const url = `${env.APP_URL}/api/periods/${activePeriod.value}`;
    const { data: period } = await getData(url);
    if (!period) return;
    periodDiv.append(`
    <div class="p-2">
    <h4>Periodo actual</h4>
        <div class="row">
            <div class="col-12">
                <p>
                    Nombre 
                </p>
            </div>
            <div class="col-12">
                <input class="form-control" id="name-period-${id}" originalValue=${period.label} value=${period.label}> 
                <button class="btn btn-primary m-2 hidden" id="btn-period-name-${id}"  type="button" >Guardar</button>
            </div>
            
        </div>
        <div class="col-8">
            <div class="row">
                <p>
                    Inicio del periodo:
                </p>
                <input class="form-control" type="text" disabled value=${period.startDate}>

            </div>
            <div class="row">
                <p>
                    Fin del periodo:
                </p>
                <input class="form-control" type="text" disabled value=${period.endDate}>
            </div>
        </div>
    </div>
    `);
    const btn = $(`#btn-period-name-${id}`);
    const inputNamePeriod = $(`#name-period-${id}`);
    inputNamePeriod.on("input", function () {
        const currentValue = $(this).val();
        const originalValue = $(this).attr("originalValue");
        if (currentValue == originalValue) return btn.addClass("hidden");
        return btn.removeClass("hidden");
    });

    btn.click(function (e) {
        e.preventDefault();
        const label = inputNamePeriod.val();
        handleUpdatePeriod(period.id, label);
        btn.addClass("hidden");
    });
}

async function renderMaxStudents(id, maxStudents) {
    const maxStudenDiv = $(`#max-students-${id}`);
    console.log({ maxStudents, maxStudenDiv });
    maxStudenDiv.append(
        `
        <div class="p-2">
            <p> Alumnos por grupo
                <input type="text" class="form-control" id="name-max-students-${id}" originalValue="${maxStudents.value}" value="${maxStudents.value}">
                <button class="btn btn-primary m-2 hidden" id="btn-max-students-name-${id}" type="button" >Guardar</button> 
            </p>
        <div>`
    );

    const btn = $(`#btn-max-students-name-${id}`);
    const inputMaxStudent = $(`#name-max-students-${id}`);
    inputMaxStudent.on("input", function () {
        const currentValue = $(this).val();
        const originalValue = $(this).attr("originalValue");
        if (currentValue == originalValue) return btn.addClass("hidden");
        return btn.removeClass("hidden");
    });

    btn.click(function (e) {
        e.preventDefault();
        const value = inputMaxStudent.val();
        if (isPositiveInteger(value)) {
            handleUpdateSetting(maxStudents.id, value);
            btn.addClass("hidden");
            return;
        }
        addToast(
            "danger",
            "Por favor, escribe un número entero positivo para la cantidad de grupos.",
            4
        );
    });
}

async function renderCreatePeriodModal(id, periodSettingId) {
    const modalcreatePeriodDiv = $(`#modal-create-period-${id}`);
    modalcreatePeriodDiv.append(
        `
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Crear periodo</h4>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <div class="row">
                            <label class="control-label" for="create-name-period-${id}">Nombre del periodo:</label>
                            <input class="form-control" id="create-name-period-${id}" > 
                        </div>
                        <div class="row">
                            <label class="control-label" for="start-date-${id}">Inicio del periodo:</label>
                            <input class="form-control" id="start-date-${id}" type="text">
                            <span class="bootstrap-icons" aria-hidden="true"><i class="bi bi-calendar"></i></span>
                        </div>
                        <div class="row">
                            <label class="control-label" for="end-date-${id}">Fin del periodo:</label>
                            <input class="form-control" id="end-date-${id}" type="text">
                            <span class="bootstrap-icons" aria-hidden="true"><i class="bi bi-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn-save-period-${id}">Guardar</button>
                </div>
            </div>
        </div>`
    );
    const startDateInput = $(`#start-date-${id}`);
    const endDateInput = $(`#end-date-${id}`);
    startDateInput.datepicker();
    endDateInput.datepicker();
    const btn = $(`#btn-save-period-${id}`);
    const nameInput = $(`#create-name-period-${id}`);
    btn.click(async function (e) {
        e.preventDefault();
        if (!nameInput.val())
            return addToast(
                "danger",
                "Favor de ingresar un valor al nombre del periodo",
                4
            );

        if (!startDateInput.val())
            return addToast(
                "danger",
                "Favor de ingresar un valor al inicio del periodo",
                4
            );
        if (!endDateInput.val())
            return addToast(
                "danger",
                "Favor de ingresar un valor al fin del periodo",
                4
            );
        const label = nameInput.val();
        const startDate = parseDatepickerDate(startDateInput.val());
        const endDate = parseDatepickerDate(endDateInput.val());
        if (new Date(startDate) > new Date(endDate))
            return addToast(
                "danger",
                "El inicio del periodo debe empezar antes que el fin del periodo",
                4
            );

        const res = await handleCreatePeriod({
            label,
            startDate,
            endDate,
        });
        if (!res)
            return addToast(
                "danger",
                "Algo ha salido mal, favor de intentar más tarde o pruebe con otro nombre de periodo.",
                4
            );
        const { id: newPeriodId } = res;
        await handleUpdateSetting(periodSettingId, newPeriodId + "");
        modalcreatePeriodDiv.modal("hide");
        fetchData();
    });
}

async function fetchData() {
    const url = `${env.APP_URL}/api/settings`;
    const rawData = await getData(url);
    const results = {};
    rawData.data.map((obj) => {
        const splitedObj = obj.key.split(".");
        const agroupationKey = splitedObj[1];
        const key = splitedObj[2];
        const existingData = results[agroupationKey];
        results[agroupationKey] = {
            ...existingData,
            [key]: obj,
        };
    });
    const data = Object.values(results);
    const tabDiv = $("#nav-tab-config-internal");
    const contentDiv = $("#nav-tabContent-config-internal");
    contentDiv.empty();
    tabDiv.empty();
    data.forEach((obj, index) => {
        const {
            RECEIVE_UPCOMING: receiveUpcomingSolicitudes,
            ACTIVE_ID_PERIOD: activePeriod,
            MAX_STUDENTS_PER_GROUP: maxStudents,
        } = obj;
        const { id, key, value } = receiveUpcomingSolicitudes;
        const course = capitalizeFirstLetter(
            convertWordsToAccentWords(formatSetting(key))
        );
        //console.log(activePeriod);

        tabDiv.append();
        const isFirstRender = index == 0;
        tabDiv.append(
            `<a class="nav-link ${
                isFirstRender && " show active"
            }" id="nav-tab-${id}" data-toggle="tab" href="#nav-${id}" role="tab" aria-controls="nav-${id}" aria-selected="true">
            ${course}
            </a>`
        );
        contentDiv.append(
            `<div class="tab-pane fade ${
                isFirstRender && "show active"
            }" id="nav-${id}" role="tabpanel" aria-labelledby="nav-tab-${id}">
            <div class="row">
                <div id="period-${id}">
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row" id="max-students-${id}">
                    </div>
                    <div class="row" id="check-${id}">
                    </div>
                </div>
            </div>
            <div class="row">
                <button class="btn btn-primary" id="btn-create-period-${id}">Crear periodo</button>
            </div>
            <div class="modal" tabindex="1" id="modal-create-period-${id}">
            </div>
          </div>
            `
        );
        $(`#btn-create-period-${id}`).click(function () {
            $(`#modal-create-period-${id}`).modal();
        });
        renderCheckSection(id, key, value);
        renderPeriod(id, activePeriod);
        renderMaxStudents(id, maxStudents);
        renderCreatePeriodModal(id, activePeriod.id);
    });
}

fetchData();
