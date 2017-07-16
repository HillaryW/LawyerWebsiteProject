$(document).ready(function () {

    $('#submit').click(function () {
        event.preventDefault();
        var password = $('#password').val();
        var confirm = $('#confirm').val();
        $.ajax({
            type: "POST",
            url: "assets/includes/updatePassword.php",
            data: {
                submit: "submit",
                password: password,
                confirm: confirm
            },
            success: function (result) {
                if (result == 'reset') {
                    window.location.replace('index.php');
                }
                else {
                    $('#error-Message').html(result);
                }
            }
        });

    });
});