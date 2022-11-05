
// Examples of making HTTP Requests with Fetch 

// GET 
const url1 = "https://jsonplaceholder.typicode.com/posts";       
getData(url1)
    .then((data) => {
        console.log(data);
    })
    .catch(error => {
        console.log(error);
    });

// POST
const url2 = 'https://jsonplaceholder.typicode.com/posts';
let data1 = {
    title: "jorge",
    body: "jorge body",
    userId: 1
}
postData(url2, data1)
    .then((data) => {
        console.log(data);
    })
    .catch(error => {
        console.log(error);
    });

// PUT
const url3 = 'https://jsonplaceholder.typicode.com/posts' + '/11';
let data2 = {
    title: "jorge",
    body: "jorge body 3000",
    userId: 1,
}
putData(url3, data2)
    .then((data) => {
        console.log(data);
    })
    .catch(error => {
        console.log(error);
    });

// DELETE
const url4 = 'https://jsonplaceholder.typicode.com/posts' + '/11';
deleteData(url4)
    .then((data) => {
        console.log(data);
    })
    .catch(error => {
        console.log(error);
    });