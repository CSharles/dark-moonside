
function verifyLogin()
{
    var json_upload =  "data=" + JSON.stringify({user: $("#username-email").val(),  password: $("#password").val(),role:"adm"});
    const url='login.php';
    let fetchData={
        method: 'POST',
        headers: {
            "Content-Type":"application/x-www-form-urlencoded"
        },
        credentials: 'include',
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
                    redirect(1);
                    break;
                    case "2":
                    redirect(2);
                    break;
                    case "3":
                    redirect(3);
                    break;
                    case "7":
                    $("#failMessage").addClass("notification-show");
                    $("#username-email").val("");
                    $("#password").val("");
                    setTimeout(()=>{
                        $("#failMessage").removeClass("notification-show");
                    },1000)
                    break;
                    default:
                    console.log('error de red');
                    console.log(data);
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

function redirect(pageId)
{
    switch (pageId) {
        case 1:
            setTimeout(()=>{location.href="adm1ndashb0ard.php"},1500)
            break;
        case 2:
            setTimeout(()=>{location.href="profile.php";},1000);
            break;
        case 3:
            setTimeout(()=>{location.href="profile.php";},500);
        default:
            break;
    }
}