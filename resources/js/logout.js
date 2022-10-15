
window.logout = () => {

    postData('http://127.0.0.1:9200/api/auth/logout')
        .then(res =>
        {
            console.log(res)
            window.location.href="http://127.0.0.1:9200/inicio";
        })
        .catch(error => {
            console.log(error);
        });
}