/**
 * Created by Hillary on 5/2/2017.
 */


$(document).ready(function () {

    $('#submit').click(function () {
        event.preventDefault();
        var fName = $('#firstname').val();
        var lName = $('#lastname').val();
        var phone = $('#phone').val();
        var email= $('#email').val();
        var password= $('#password').val();
        var password2=$('#password2').val();
        $.ajax ({
            type: "POST",
            url: "assets/includes/process-accountCreate.php",
            data: {
                submit : "submit",
                email: email,
                phone: phone,
                password: password,
                password2: password2,
                fName: fName,
                lName: lName
            },
            success: function (status) {
                console.log(status);
                if(status == 'logged in') {
                    window.location.replace('docWizard.php');
                }
                else {
                    $('#error-Message').html(status);
                    $(window).scrollTop(0);

                }
            }
        });

    })
});