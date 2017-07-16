/**
 * Created by centhian on 5/5/17.
 */

$( document ).ready(function() {
    // Get the modal
    var modal = document.getElementById('will-modal');

/*    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
        $('#disclosure').show();
    };*/

/*    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };*/

    $('#agree').click(function () {
        if(document.getElementById('accept').checked) {
            var nextBtnClass = document.getElementById("wizard-next").className;
            $('#disclosure-error').hide();
            $('#disclosure').hide();
            loadJS('assets/js/willModal.js');
            $('#select-document').hide();
            $('#one').show();
            $('#wizard-next').show();
            modal.style.display = "block";
        } else {
            $('#disclosure-error').show();
        }

    });

    $('#ok').click(function () {
        location.reload(true);
    });


     var loadJS = function (file) {
            // DOM: Create the script element
            var jsElm = document.createElement("script");
            // set the type attribute
            jsElm.type = "application/javascript";
            // make the script element load file
            jsElm.src = file;
            // finally insert the element to the body element in order to load the script
            document.body.appendChild(jsElm);
    }

});