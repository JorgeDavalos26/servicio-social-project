import { env } from "./environment";

const btnReception = $("#btn-reception");

const handleReception = async () => {
    const url = `${env.APP_URL}/api/settings/updateReceiveUpcomingSolicitudes`;
    const data = [];
    $("#receptions input").each(function () {
        data.push({
            key: $(this).attr("name"),
            value: +$(this).is(":checked"),
        });
    });
    const res = await putData(url, { input: data });
    if (res.status == 200) {
        console.log(res);
    }
    addToast("danger", res.error, 5);
};

//EVENT LISTENERS

btnReception.click((e) => {
    e.preventDefault();
    handleReception();
});
