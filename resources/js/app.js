import './bootstrap';

window.getData = async function (url = "") {

    const response = await fetch(url);
    return response.json();
}

window.postData = async (url = "", data = {}) => {

    const postData = {
        method: 'POST',
        body: JSON.stringify(data),
        headers: new Headers({
            'Content-Type': 'application/json; charset=UTF-8'
        })
    }
    const response = await fetch(url, postData);
    return response.json();
}

window.putData = async (url = "", data = {}) => {

    const putData = {
        method: 'PUT',
        body: JSON.stringify(data),
        headers: new Headers({
            'Content-Type': 'application/json; charset=UTF-8'
        })
    }
    const response = await fetch(url, putData);
    return response.json();
}

window.deleteData = async (url = "", data = {}) => {

    const deleteData = {
        method: 'DELETE',
        body: JSON.stringify(data),
        headers: new Headers({
            'Content-Type': 'application/json; charset=UTF-8'
        })
    }
    const response = await fetch(url, deleteData);
    return response.json();
}