import { env } from "./environment";

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

async function handleChangeUpcoming(value, key) {
    const url = `${env.APP_URL}/api/settings/updateReceiveUpcomingSolicitudes`;
    const data = [];
    data.push({
        key,
        value,
    });
    const res = await putData(url, { input: data });
    if (res.status == 200) {
        console.log(res);
        return;
    }
    addToast("danger", res.error, 5);
}

async function renderCheckSection(id, key, value) {
    const checkDiv = $(`#check-${id}`);
    /* console.log({
        checkDiv,
        id,
    }); */
    checkDiv.append(
        `<label>
            <input type="checkbox"  name="checkbox-${id}" id="checkbox-${id}" ${
            value == 1 ? "checked" : ""
        }/>
            Recibir solicitudes 
        </label>`
    );
    checkDiv.click((e) => {
        const checkbox = $(`#checkbox-${id}`);
        const isChecked = checkbox.is(":checked");
        handleChangeUpcoming(isChecked, key);
    });
}

async function renderPeriod(id, activePeriod) {
    const periodDiv = $(`#period-${id}`);
    console.log({
        periodDiv,
        id,
    });
    periodDiv.append(`<div>
    <h4>Periodo actual</h4>
        <label>
          Nombre <input>
        </label>
        <div class="form-group datepicker-group">
            <label class="control-label" for="calendar">Calendario:</label>
            <input class="form-control" id="calendarpenudo${id}" type="text">
            <span class="bootstrap-icons" aria-hidden="true"><i class="bi bi-calendar"></i></span>
        </div>
    </div>
    `);

    /* 
    yo creo que esto a de ser general y no se necesita, porque sin esto si funca de todas formas
    $.datepicker.regional.es = {
        closeText: 'Cerrar',
        prevText: 'Ant',
        nextText: 'Sig',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi&eacute;', 'Juv', 'Vie', 'S&aacute;b'],
        dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'S&aacute;b'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional.es); 
    */ 
    $(`#calendarpenudo${id}`).datepicker();
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
    data.forEach((obj, index) => {
        const {
            RECEIVE_UPCOMING: receiveUpcomingSolicitudes,
            ACTIVE_ID_PERIOD: activePeriod,
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
                    <div class="row" id="student-per-group-${id}">
                        <label> Alumnos por grupo
                            <input type="text" name="123"> </label>
                    </div>
                    <div class="row" id="check-${id}">
                      
                    </div>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary hidden" id="btn-reception">Actualizar cambios</button>
                </div>
            </div>
          </div>
            `
        );
        renderCheckSection(id, key, value);
        renderPeriod(id, activePeriod);
    });
    //console.log(data);
}

fetchData();
