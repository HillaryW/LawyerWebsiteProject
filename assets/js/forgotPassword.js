$(document).ready(function () {

    $('#submit').click(function () {
        event.preventDefault();
        var username = $('#email').val();
        $.ajax({
            type: "POST",
            url: "assets/includes/resetPassword.php",
            data: {
                submit: "submit",
                username: username
            },
            success: function (result) {
                if (result == 'reset') {
                    window.location.replace('login.php');
                }
                else {
                    $('#error-Message').html(result);
                }
            }
        });

    });
});