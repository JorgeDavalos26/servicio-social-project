
window.login = () => {

    let data = {
        email: "jorge6alberto@gmail.com",
        password: "1234",
    }

    postData('http://127.0.0.1:9200/api/auth/login', data)
        .then(res =>
        {
            console.log(res)
            window.location.href="http://127.0.0.1:9200/inicio";
        })
        .catch(error => {
            console.log(error);
        });
}