/**
 * Created by Hillary on 3/6/2017.
 */

$(document).ready(function () {
    $("#submit").click(function() {
        var name = $('#name').val();
        var message = $('#message').val();
        var email = $('#email').val();
        var grecaptcharesponse = grecaptcha.getResponse();
        $.ajax({
            type: "POST",
            url:"assets/includes/ValidateContactPage.php",
            data: {
                submit: "submit",
                name: name,
                message: message,
                email: email,
                grecaptcha : grecaptcharesponse
            },
            success: function(result) {
                console.log(result);
                if(result == "Your contact request have submitted successfully.") {
                    window.location.reload(true);
                    alert(result);

                } else {
                    alert(result);
                }

            }
        });
    });
});