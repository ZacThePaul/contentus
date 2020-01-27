// let user = $.ajax({
//     url: 'apihandler.php?class=Database&method=select',
//     type: 'GET',
//     success: function(data) {
//         let user = JSON.parse(data);
//         $('#username').text(user.name);
//     }
// });


function createUser(event) {

    // Data gathered here -> API handler -> method -> API Handler -> Here -> View

    event.preventDefault();

    const data = {
        name: $('#registerName').val(),
        email: $('#registerEmail').val(),
        password: $('#registerPassword').val(),
        class: 'RegisterController',
        method: 'create'
    };

    $.ajax({
        url: 'apihandler.php',
        type: 'POST',
        data: data,
        success: function(response) {
            // location.href = 'home';
            console.log(response);
            if(response !== 'not taken') {
                // give error here if email is taken
            }
            else {
                // if email is not taken
                location.href = 'login';
            }
        },
        error: function () {
            console.log('error')
        }
    });

}

function loginUser(event) {

    // Data gathered here -> API handler -> method -> API Handler -> Here -> View

    event.preventDefault();

    const data = {
        email: $('#loginEmail').val(),
        password: $('#loginPassword').val(),
        class: 'loginController',
        method: 'login'
    };

    $.ajax({
        url: 'apihandler.php',
        type: 'POST',
        data: data,
        success: function(response) {
            if(!response) {
                console.log('good but error');
                console.log(response);
            }
            else if (response) {
                location.href = 'dashboard';
            }
        },
        error: function () {
            console.log('error')
        }
    });

}
