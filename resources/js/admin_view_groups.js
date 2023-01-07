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
    console.log(res.status);
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
        const groupsResponse = await getData(`${env.APP_URL}/api/groups?periodId=${periodId}&paginated=false`);

        return groupsResponse.data;
    } catch (e) {
        addToast("danger", "Error retrieving groups", 10);
        console.log(e);
        return null;
    }
}

function renderGroups(groups) {

}

function renderNoGroupsCreatedMessage() {

}

document.addEventListener("DOMContentLoaded", async function () {
    await fetchPeriods();

    periodSelect.addEventListener("change", (event) => {
        const periodId = event.target.value;
        const groups = fetchGroups(periodId);

        if (groups) {
            renderGroups(groups);
        } else {
            renderNoGroupsCreatedMessage();
        }
    });
})


