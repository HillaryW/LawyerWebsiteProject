/**
 * Created by Hillary on 3/15/2017.
 */

$(document).ready(function() {
//when this button is clicked user is logged out of the application
    $('#nav-logout').click(function () {
        $.post('assets/includes/destroySession.php', {}, function (data) {
            window.location.reload();
        });

    });
});