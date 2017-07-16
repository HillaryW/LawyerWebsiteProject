/**
 * Created by Hillary on 3/10/2017.
 */

$(document).ready(function () {

    $('#submit').click(function () {
        event.preventDefault();
        var username= $('#email').val();
        var password= $('#password').val();
        $.ajax ({
            type: "POST",
            url: "assets/includes/process-login.php",
            data: {
                submit : "submit",
                username: username,
                password: password
            },
            success: function (result) {
                console.log(result);
                if(result == 'logged in') {
                    window.location.reload(true);
                } else if (result == 'tempPW'){
                    window.location.replace('newPassword.php')
                }
                else {
                    $('#error-Message').html(result);
                }
            }
        });

    });

    $('#create-acct').click(function () {
        window.location.replace('accountCreate.php');
    });

    $('#forgot-pw').click(function () {
        window.location.replace('forgotPassword.php');
    });
});