
function verifyLogin()
{
    const url='checkuser.php';
    let data={
        user: $("#username-email").val(),
        password: $("#password").val()
    }
    let fetchData={
        method: 'POST',
        body:data,
        headers:new Headers()
    }
    fetch(url,fetchData) // Call the fetch function passing the url of the API as a parameter
    .then(function(response){  
            console.log(response.status);
        return response;
    })
    .then(response=>response.json())
    .then(function(data) {
        // Your code for handling the data you get from the API
    })
    .catch(function(error) {
        console.log('There has been a problem with your fetch operation: ' + error.message);
    });
};




