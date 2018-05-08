
function verifyLogin()
{
    var json_upload =  "data=" + JSON.stringify({user: $("#username-email").val(),  password: $("#password").val()});
    const url='../src/Entity/checkuser.php';
    let fetchData={
        method: 'POST',
        headers: {
            "Content-Type":"application/x-www-form-urlencoded"
        },
        body:json_upload
    }
    fetch(url,fetchData) // Call the fetch function passing the url of the API as a parameter
    .then(function(response){  
        if(response.ok){
            response.text()
            //.then(response=>response.json())
            .then(function(data) {
                // Your code for handling the data you get from the API
                switch(data){
                    case "1":
                    $("#successInMsg").addClass("notification-show");
                    redirect();
                    break;
                    case "7":
                    $("#failMessage").addClass("notification-show");
                    $("#username-email").val("");
                    $("#password").val("");
                    setTimeout(()=>{
                        $("#failMessage").removeClass("notification-show");
                    },1500)
                    break;
                    default:
                    console.log('error de red');
                    $("#username-email").val("");
                    $("#password").val("");
                }
            });
        }
    })
    .catch(function(error) {
        console.log('There has been a problem with your fetch operation: ' + error.message);
    });
};

function redirect()
{
    setTimeout(() => {
        location.href = "adm1ndashb0ard.php"}, 2000)
}




