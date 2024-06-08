var user = function() {

async function loginUser(event) {
    event.preventDefault();
    let formLogin = document.getElementById("id-form-login");
    let userName  = formLogin.username.value;
    let password  = formLogin.password.value;
    let user      = formLogin.userselect.value;
    let action    = '';
    let data      = '';
    let location  = '';
   
    switch (user) {
        case 'admin':
            action    = "login";
            data      = {"user_name" : userName, "password" : password};
            location  = "./products.php";
            break;
        case 'employee':
            action    = "login_employee";
            data      = {"user_name" : userName};
            location  = "./total_by_customer.php";
            break;
        case 'customer':
            action    = "login_customer";
            data      = {"user_name" : userName};
            location  = "./products.php";
            break;
        default:
            break;
    }
    await login(action, data, location);
}

async function login(action, data, location) {
    await nanoajax.ajax({url: `rpc/user.rpc.php?action=`+ action, method: 'POST', body: JSON.stringify(data)}, function(code, responseText) {
        try {
            const result = JSON.parse(responseText);
            console.log(responseText);
            if(result.response.user) { 
                window.location.href = location;
            } else {
                let massage = result.response.error ? result.response.error : "Something wrong happened";
                new swal("Ohh no!", `${massage}!`, "warning");
            }
        } catch(err) {
            console.log(err);
        }
    })
}

async function logoutUser()
{
    let action    = 'logout';
    await nanoajax.ajax({url: `rpc/user.rpc.php?action=`+ action, method: 'POST'}, function(code, responseText) {
        try {
            const result = JSON.parse(responseText);
            if(result.response) {
                window.location =  window.location.origin; 
            }
        } catch(err) {
            console.log(err);
        }
    })
}
return {
    loginUser,
    logoutUser
}
}();