import {env} from "./environment";

const periodSelect = document.getElementById("period_select");
const groupsContainer = document.getElementById('groups_container');

const fetchPeriods = async () => {
    const url = `${env.APP_URL}/api/periods?paginated=false`;
    const res = await getData(url);
    if (res.status === 200) {
        return renderPeriodsSelect(res.data);
    }
    addToast("danger", "Error consiguiendo los periodos.", 5);
};

async function renderPeriodsSelect(periods) {
    periodSelect.replaceChildren();
    const periodsToRender = [
        {
            id: 0,
            label: "Sin seleccionar",
        },
        ...periods,
    ];
    for (const period of periodsToRender) {
        const option = new Option(period.label, period.id);
        periodSelect.insertAdjacentElement("beforeend", option);
    }
}

async function fetchGroups(periodId) {
    try {
        const groupsResponse = await getData(`${env.APP_URL}/api/groups?paginated=0&periodId=${periodId}`);

        if (groupsResponse.status !== 200) {
            throw new Error("Something went wrong");
        }

        return groupsResponse.data;
    } catch (e) {
        addToast("danger", "Error consiguiendo grupos", 10);
        return null;
    }
}

function renderGroups(groups) {
    groupsContainer.replaceChildren();

    for (let i = 0; i < groups.length; i++) {
        const group = groups[i];
        let tableRows = "";

        for (let j = 0; j < group.solicitudes.length; j++) {
            const solicitude = group.solicitudes[j];
            tableRows += `
                <tr class="${solicitude.payed ? 'solicitude-not-payed' : ''}">
                    <th scope="row">${solicitude.id}</th>
                    <td>${solicitude.name}</td>
                    <td>${solicitude.firstLastName}</td>
                    <td>${solicitude.secondLastName}</td>
                    <td >
                        <a class="see-details-icon"
                            href="/solicitud/${solicitude.id}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            `;
        }

        groupsContainer.insertAdjacentHTML('beforeend', `
            <div class="my-4">
                <h3>Grupo: ${group.name.split("_").at(-1)}</h3>
                <table class="mt-2 table">
                    <thead>
                        <tr>
                            <th># Solicitud</th>
                            <th>Nombre(s)</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${tableRows}
                    </tbody>
                </table>
            </div>
        `);
    }
}

function renderNoGroupsCreatedMessage() {
    groupsContainer.replaceChildren();

    groupsContainer.insertAdjacentHTML("beforeend", `
        <div class="d-flex justify-content-center align-items-center">
            <h2>No hay grupos registrados</h2>
        </div>
    `);
}

document.addEventListener("DOMContentLoaded", async function () {
    await fetchPeriods();

    periodSelect.addEventListener("change", async (event) => {
        const periodId = event.target.value;
        const groups = await fetchGroups(periodId);

        if (groups) {
            renderGroups(groups);
        } else {
            renderNoGroupsCreatedMessage();
        }
    });
})


