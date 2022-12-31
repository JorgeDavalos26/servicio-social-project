import { env } from "./environment";

let page = 1;
const perPage = 10;
let scholarLevel;
let scholarCourse;

const btnFilter = $("#btn-filter");
const selectSchoolarLevel = $("#select-scholar-level");
const selectCourseLevel = $("#select-course-level");

/**
 * Function to update table of solicitudes
 * @param {array} data array of solicitudes
 * @param {string} tbody id of the tbody element where the rows will be inserted
 */
const renderTable = (data = [], tbody = "#table_admin_body") => {
    const tableBody = $(tbody);
    tableBody.empty();

    for (const row of data) {
        console.log(row);
        tableBody.append(`
        <tr>
        <th scope="row">${row.id}</th>
        <td>${row.form.label}</td>
        <td>${row.form.scholarCourse}</td>
        <td>${row.form.scholarLevel}</td>
        <td>${row.username}</td>
        </tr>
    `);
    }
};
/**
 * A function to update scholarLevel and scholarCourse with current selection
 */
const filterData = () => {
    scholarLevel = selectSchoolarLevel.find(":selected").text() ?? "Tecnólogo";
    scholarCourse = selectCourseLevel.find(":selected").text() ?? "Nivelación";
};

/**
 * Function to bring solicitudes from backend
 * @param {function} processData function to call when the array of solicitudes is fetched
 * @returns
 */
const fetchSolicitudes = async (processData = (data) => {}) => {
    const url = `${
        env.APP_URL
    }/api/solicitudes?paginated=${true}&perPage=${perPage}&page=${page}&scholarLevel=${scholarLevel}&scholarCourse=${scholarCourse}`;
    const res = await getData(url);

    if (res.status == 200) {
        const pages = calculatePages(
            res.additional_data["paginationTotalItems"],
            page,
            perPage,
            3
        );
        renderPages(pages);
        return processData(res.data);
    }
    addToast("danger", res.error, 5);
};

/**
 *
 * @param {Object} An object with properties of the pages (array of integers) and current page(integer)
 * @param {string} div String with the id where the pagination will be added
 */
async function renderPages(
    { pages, currentPage, totalPages },
    div = "#pagination"
) {
    const pagination = $(div);
    pagination.empty();
    pagination.append('<li id="before-page"><a>&laquo;</a></li>');
    for (const newPage of pages) {
        pagination.append(`
        <li id="page-${newPage}"><a>${newPage}</a></li>
        `);
        $(`#page-${newPage}`).click((e) => {
            e.preventDefault();
            page = newPage;
            fetchSolicitudes(renderTable);
        });
    }
    pagination.append('<li id="next-page"><a>&raquo;</a></li>');
    $("#before-page").click((e) => {
        e.preventDefault();
        if (page <= 1) return;
        page--;
        fetchSolicitudes(renderTable);
    });
    $("#next-page").click((e) => {
        e.preventDefault();
        if (page >= totalPages) return;
        page++;
        fetchSolicitudes(renderTable);
    });
}

//EVENT LISTENERS

btnFilter.click((e) => {
    e.preventDefault();
    page = 1;
    filterData();
    fetchSolicitudes(renderTable);
});

//STARTUP
filterData();
fetchSolicitudes(renderTable);
