/**
 * Created by centhian on 5/12/17.
 */
$(document).ready(function () {

    var userData = {};

    $('#wizard-next').click(function () {
        var nextBtnClass = document.getElementById("wizard-next").className;
        if(nextBtnClass == "poa-next") {
            $('#one').hide();
            $('#poa-wizard').append(document.getElementById('poa'));
            $('#poa').show();
            $('#wizard-back').removeClass("poa-back").addClass("poa-back-two").show();
            $('#wizard-next').removeClass("poa-next").addClass("poa-next-two");
        } else if (nextBtnClass == "poa-next-two"){
            formatInputData();
            $('#poa').hide();
            $('#confirmation').show();
            $('#form-submit').show();
            $('#wizard-back').removeClass("poa-back-two").addClass("confirmation-back");
            $('#wizard-next').removeClass("poa-next-two").addClass("confirmation-next").hide();
        }
    });

    $('#wizard-back').click(function () {
        var backBtnClass = document.getElementById("wizard-back").className;
        if(backBtnClass == "poa-back-two") {
            $('#poa').hide();
            $('#one').show();
            $('#wizard-back').removeClass("poa-back-two").addClass("poa-back").hide();
            $('#wizard-next').removeClass("poa-next-two").addClass("poa-next").show();
        } else if (backBtnClass == "confirmation-back"){
            $('#confirmation').hide();
            $('#poa').show();
            $('#user-input').empty();
            $('#errorResult').empty();
            $('#errorResult').hide();
            $('#form-submit').hide();
            $('#wizard-back').removeClass("confirmation-back").addClass("poa-back-two");
            $('#wizard-next').removeClass("confirmation-next").addClass("poa-next-two").show();
        }
    });

    $('#form-submit').click(function () {
        $('#form-submit').attr('disabled', true);
        var poa;
        if(document.getElementById("form-submit").className === "hpoa"){
            poa = "health";
        } else {
            poa = "financial";
        }

        $.ajax({
            type: "POST",
            url: "assets/includes/process-modal.php",
            data: {
                submit: "submit",
                poa: poa,
                userInput: userData
            },
            success: function (result) {
                console.log(result);
                $('#form-submit').attr('disabled', false);
                if (result == "No Errors") {
                    $('#confirmation').hide();
                    $('#wizard-back').hide();
                    $('#form-submit').hide();
                    $('#ok').show();
                    $('#result').show();
                } else {
                    $('#errors').show();
                    $('#confirmation').hide();
                    $.each(JSON.parse(result), function (i, val) {
                        $('#errorResult').append(document.createTextNode(val),
                            document.createElement("br"));
                    });
                }
            }
        });
    });

    var formatInputData = function () {
        $('#user-input').empty();
        var fName = $('#fName').val();
        var lName = $('#lName').val();
        var phoneNum = $('#phone').val();
        var email = $('#email').val();
        var aifFName = $('#aif-fName').val();
        var aifLName = $('#aif-LName').val();
        var aifEmail = $('#aif-email').val();
        var aifPhone = $('#aif-phoneNum').val();

        if (fName != "") {
            userData["First Name"] = fName;
        }
        if (lName != "") {
            userData["Last Name"] = lName;
        }
        if (phoneNum != "") {
            userData["Phone Number"] = phoneNum;
        }
        if (email != "") {
            userData["Email"] = email;
        }
        if (aifFName != "") {
            userData["Attorney-in-fact First Name"] = aifFName;
        }
        if (aifLName != "") {
            userData["Attorney-in-fact Last Name"] = aifLName;
        }
        if (aifEmail != "") {
            userData["Attorney-in-fact Email"] = aifEmail;
        }
        if (aifPhone != "") {
            userData["Attorney-in-fact Phone Number"] = aifPhone;
        }
        for(var field in userData) {
            $('#user-input').append(field + ": " + userData[field] + "</br>");
        }
    };
});