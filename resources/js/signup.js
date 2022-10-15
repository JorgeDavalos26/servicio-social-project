
window.signup = () => {

    let data = {
        username: "Jorge Davalos",
        email: "jorge6alberto@gmail.com",
        password: "1234",
    }

    postData('http://127.0.0.1:9200/api/auth/register', data)
        .then(res =>
        {
            if(res.error === "Email repeated")
            {
                console.log("Email repeated!!")
            }
            else
            {
                console.log(res)
                window.location.href="http://127.0.0.1:9200/inicio";
            }
        })
        .catch(error => {
            console.log(error);
        });
}