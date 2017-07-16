/**
 * Created by centhian on 5/5/17.
 */

$(document).ready(function () {
    var userData = {};
    var radioBtns = {};
    var fName;
    var lName;
    var phoneNum;
    var email;
    var business;
    var maxAssets;
    var realEstate;
    var spouseFName;
    var spouseLName;
    var hasDependent;
    var numOfChildren = 0;
    var children = [];
    var cFName;
    var cLName;
    var cAge;
    var minors = false;
    var predeceased;
    var providePredeceased;
    var numOfPredeceased = 0;
    var predeceasedChildren = [];
    var personalRepFName;
    var personalRepLName;
    var personalRepEmail;
    var personalRepPhone;
    var aifFName;
    var aifLName;
    var aifEmail;
    var aifPhone;
    var guardianFName;
    var guardianLName;
    var guardianCity;
    var guardianState;
    var guardianCountry;
    var altGuardianFName;
    var altGuardianLName;
    var altGuardianCity;
    var altGuardianState;
    var altGuardianCountry;
    var ownHome;
    var beneficiaries = [];
    var beneficiary;
    var benName;
    var benCity;
    var benState;
    var benCountry;
    var benPercent;
    var numOfBens = 0;
    var totalBenPercent = 0;
    var wasiyyaBequest;

    // When the user clicks the next buttons
    $('#wizard-next').click(function () {
        var nextBtnClass = document.getElementById("wizard-next").className;


        if (nextBtnClass == "one-next") {
            if (validateOne()) {
                $('#one').hide();
                $('#validation').hide();
                $('#will-wizard').append(document.getElementById('two'));
                $('#two').show();
                $('#wizard-back').show().removeClass("one-back").addClass("two-back-a");
                $('#wizard-next').removeClass("one-next").addClass("two-next-a");
            }

        } else if (nextBtnClass == "two-next-a") {
            if (validateRadio($('input[name=business]:checked').val())) {
                $('#validation').hide();
                $('#a').hide();
                $('#b').show();
                $('#wizard-back').removeClass("two-back-a").addClass("two-back-b");
                $('#wizard-next').removeClass("two-next-a").addClass("two-next-b");
            }
        } else if (nextBtnClass == "two-next-b") {
            if (validateRadio($('input[name=maxAssets]:checked').val())) {
                $('#validation').hide();
                $('#b').hide();
                $('#c').show();
                $('#wizard-back').removeClass("two-back-b").addClass("two-back");
                $('#wizard-next').removeClass("two-next-b").addClass("two-next");
            }
        } else if (nextBtnClass == "two-next") {
            if (validateRadio($('input[name=realEstate]:checked').val())) {
                $('#validation').hide();
                if (checkAnswers()) {
                    $('#two').hide();
                    $('#wizard-back').hide().removeClass("two-back").addClass("ok");
                    $('#wizard-next').hide();
                    sendReferralEmail();
                } else {
                    $('#two').hide();
                    $('#will-wizard').append(document.getElementById('primary-residence'));
                    $('#primary-residence').show();
                    $('#wizard-back').removeClass("two-back").addClass("primary-residence-back");
                    $('#wizard-next').removeClass("two-next").addClass("primary-residence-next");
                }
            }
        } else if (nextBtnClass == "primary-residence-next") {
            ownHome = $('input[name=own-home]:checked').val();
            if (validateRadio(ownHome)) {
                $('#primary-residence').hide();
                $('#validation').hide();
                $('#will-wizard').append(document.getElementById('three'));
                $('#three').show();
                $('#wizard-back').show().removeClass("primary-residence-back").addClass("three-back");
                $('#wizard-next').removeClass("primary-residence-next").addClass("three-next");

                if (ownHome == 'yes') {
                    $('#personal-residence-to-spouse').show();
                } else {
                    $('#personal-residence-to-spouse').hide();
                }
                userData['Own Residence'] = ownHome;
            }
        } else if (nextBtnClass == "three-next") {
            var hasSpouse = $('input[name=spouse]:checked').val();
            if (validateRadio(hasSpouse)) {
                $('#validation').hide();
                //add check for 2 new radio butons
                var residenceToSpouse = $('input[name=residence-to-spouse]:checked').val();
                var personalToSpouse = $('input[name=personal-to-spouse]:checked').val();
                if (((hasSpouse == 'yes' && validateThree()) &&
                    (((ownHome == 'yes' && validateRadio(residenceToSpouse)) || ownHome == 'no') &&
                    validateRadio(personalToSpouse))) ||
                    (hasSpouse == 'no')) {
                    $('#validation').hide();
                    $('#three').hide();
                    $('#will-wizard').append(document.getElementById('four'));
                    $('#four').show();
                    $('#wizard-back').removeClass("three-back").addClass("four-back");
                    $('#wizard-next').removeClass("three-next").addClass("four-next");
                }
                if (residenceToSpouse) {
                    userData['Residence To Spouse'] = residenceToSpouse;
                }
                if (personalToSpouse) {
                    userData['Personal To Spouse'] = personalToSpouse;
                }
                radioBtns['Has Spouse'] = hasSpouse;
            }
        } else if (nextBtnClass == "four-next") {
            hasDependent = $('input[name=dependent]:checked').val();
            if (validateRadio(hasDependent)) {
                if (hasDependent == 'yes') {
                    $('#four').hide();
                    $('#will-wizard').append(document.getElementById('adopted'));
                    $('#adopted').show();
                    $('#wizard-back').removeClass("four-back").addClass("adopted-back").show();
                    $('#wizard-next').removeClass("four-next").addClass("adopted-next");
                } else {
                    $('#validation').hide();
                    $('#four').hide();
                    $('#will-wizard').append(document.getElementById('predeceased'));
                    $('#predeceased').show();
                    $('#wizard-back').removeClass("four-back").addClass("predeceased-back").show();
                    $('#wizard-next').removeClass("four-next").addClass("predeceased-next");
                }
                radioBtns['Has Dependent'] = hasDependent;
            }
        } else if (nextBtnClass == 'adopted-next') {
            var adoptedChildren = $('input[name=adopted-child]:checked').val();
            if (validateRadio(adoptedChildren)) {
                if (adoptedChildren == 'no') {
                    $('#validation').hide();
                    $('#adopted').hide();
                    $('#will-wizard').append(document.getElementById('dependent-info'));
                    $('#dependent-info').show();
                    $('#wizard-back').removeClass("adopted-back").addClass("dependent-info-back").show();
                    $('#wizard-next').removeClass("adopted-next").addClass("dependent-info-next");
                } else {
                    sendReferralEmail();
                    $('#adopted').hide();
                    $('#wizard-back').hide().removeClass("adopted-back").addClass("ok");
                    $('#wizard-next').hide();
                }
            }
        } else if (nextBtnClass == 'dependent-info-next') {
            if (hasDependent == 'no' || numOfChildren > 0) {
                $('#validation').hide();
                $('#dependent-info').hide();
                if (minors) {
                    $('#will-wizard').append(document.getElementById('minors'));
                    $('#minors').show();
                    $('#wizard-back').removeClass("dependent-info-back").addClass("minors-back-a");
                    $('#wizard-next').removeClass("dependent-info-next").addClass("minors-next-a");
                } else {
                    $('#will-wizard').append(document.getElementById('predeceased'));
                    $('#predeceased').show();
                    $('#wizard-back').removeClass("dependent-info-back").addClass("predeceased-back");
                    $('#wizard-next').removeClass("dependent-info-next").addClass("predeceased-next");
                    if (numOfChildren > 0) {
                        userData['Children'] = children;
                    }
                }
            } else {
                $('#validation').show();
            }
        } else if (nextBtnClass == "minors-next-a") {
            if (validateGaurdian(false)) {
                $('#validation').hide();
                $('#guardian').hide();
                $('#alt-guardian').show();
                $('#wizard-back').removeClass("minors-back-a").addClass("minors-back");
                $('#wizard-next').removeClass("minors-next-a").addClass("minors-next");
            }
        } else if (nextBtnClass == "minors-next") {
            if (validateGaurdian(true)) {
                $('#validation').hide();
                $('#minors').hide();
                $('#will-wizard').append(document.getElementById('predeceased'));
                $('#predeceased').show();
                $('#wizard-back').removeClass("minors-back").addClass("predeceased-back");
                $('#wizard-next').removeClass("minors-next").addClass("predeceased-next");
                if (numOfChildren > 0) {
                    userData['Children'] = children;
                }
            }
        } else if (nextBtnClass == "predeceased-next") {
            var hasPredeceased = $('input[name=predeceased-child]:checked').val();
            if (validateRadio(hasPredeceased)) {
                var valid = true;
                if (hasPredeceased == 'yes') {
                    predeceased = true;
                    var provideFor = $('input[name=predeceased-provide]:checked').val();
                    if (!validateRadio(provideFor)) {
                        valid = false;
                    }
                } else {
                    predeceased = false;
                }
                radioBtns['Has Predeceased'] = hasPredeceased;
                if (valid) {
                    if (provideFor == 'no' || provideFor == null) {
                        $('#validation').hide();
                        $('#predeceased').hide();
                        if (hasPredeceased == 'yes') {
                            $('#will-wizard').append(document.getElementById('predeceased-info'));
                            $('#predeceased-info').show();
                            $('#wizard-back').removeClass("predeceased-back").addClass("predeceased-info-back");
                            $('#wizard-next').removeClass("predeceased-next").addClass("predeceased-info-next");
                        } else {
                            $('#will-wizard').append(document.getElementById('wasiyya-bequest'));
                            $('#wasiyya-bequest').show();
                            $('#wizard-back').removeClass("predeceased-back").addClass("wasiyya-bequest-back");
                            $('#wizard-next').removeClass("predeceased-next").addClass("wasiyya-bequest-next");
                        }
                    } else {
                        sendReferralEmail();
                        $('#predeceased').hide();
                        $('#wizard-back').hide().removeClass("predeceased-back").addClass("ok");
                        $('#wizard-next').hide();
                    }
                }
            }
        } else if (nextBtnClass == "predeceased-info-next") {
            if (validatePredeceased()) {
                $('#predeceased-info').hide();
                $('#will-wizard').append(document.getElementById('wasiyya-bequest'));
                $('#wasiyya-bequest').show();
                $('#wizard-back').removeClass("predeceased-info-back").addClass("wasiyya-bequest-back");
                $('#wizard-next').removeClass("predeceased-info-next").addClass("wasiyya-bequest-next");
                if (numOfPredeceased > 0) {
                    userData['Predeceased Children'] = predeceasedChildren;
                }
            }
        } else if (nextBtnClass == "wasiyya-bequest-next") {
            $('#bequest-percent-error').hide();
            $('#validation').hide();
            wasiyyaBequest = $('input[name=designate]:checked').val();
            if (validateRadio(wasiyyaBequest)) {
                if (wasiyyaBequest == 'yes') {
                    if (validateBequestPercent()) {
                        $('#wasiyya-bequest').hide();
                        $('#will-wizard').append(document.getElementById('bequest-info'));
                        $('#bequest-info').show();
                        $('#wizard-back').removeClass("wasiyya-bequest-back").addClass("bequest-info-back");
                        $('#wizard-next').removeClass("wasiyya-bequest-next").addClass("bequest-info-next");
                    }
                } else {
                    $('#validation').hide();
                    $('#wasiyya-bequest').hide();
                    $('#will-wizard').append(document.getElementById('five'));
                    $('#five').show();
                    $('#wizard-back').removeClass("wasiyya-bequest-back").addClass("five-back-a");
                    $('#wizard-next').removeClass("wasiyya-bequest-next").addClass("five-next-a");
                    $('#alt-personal-rep-fName').focus();
                }
                radioBtns['Wasiyya Bequest'] = wasiyyaBequest;
            }
        } else if (nextBtnClass == "bequest-info-next") {
            $('#total-percent-error').hide();
            $('#percent-error').hide();
            if ((numOfBens > 0 || validateBeneficiary()) && validateBequestInfo()) {
                $('#validation').hide();
                $('#bequest-info').hide();
                $('#will-wizard').append(document.getElementById('five'));
                $('#five').show();
                $('#wizard-back').removeClass("bequest-info-back").addClass("five-back-a");
                $('#wizard-next').removeClass("bequest-info-next").addClass("five-next-a");
                $('#alt-personal-rep-fName').focus();
                if (numOfBens > 0) {
                    userData['Wasiyya Beneficiary'] = beneficiaries;
                }
            }
        } else if (nextBtnClass == "five-next-a") {
            if (validateFive(false)) {
                $('#validation').hide();
                $('#personalRepresentative-info').hide();
                $('#alt-personalRepresentative-info').show();
                $('#wizard-back').removeClass("five-back-a").addClass("five-back");
                $('#wizard-next').removeClass("five-next-a").addClass("five-next");
                $('#alt-personal-rep-fName').focus();
            }
        } else if (nextBtnClass == "five-next") {
            if (validateFive(true)) {
                $('#validation').hide();
                $('#five').hide();
                $('#poa-wizard').append(document.getElementById('poa'));
                $('#poa').show();
                $('#wizard-back').removeClass("five-back").addClass("poa-back");
                $('#wizard-next').removeClass("five-next").addClass("poa-next");
                $('#aif-fName').focus();

            }
        } else if (nextBtnClass == "poa-next") {
            if (validatePOA()) {
                $('#validation').hide();
                formatInputData();
                $('#poa').hide();
                $('#confirmation').show();
                $('#form-submit').show();
                $('#wizard-back').removeClass("poa-back").addClass("confirmation-back");
                $('#wizard-next').removeClass("poa-next").addClass("confirmation-next").hide();
            }
        }
    });

    // When the user clicks the submit button - validates user input server side
    $('#form-submit').click(function () {
        var submitBtnClass = document.getElementById("form-submit").className;
        if (submitBtnClass == "form-submit") {
            $('#form-submit').attr('disabled', true);
            $('#wizard-back').attr('disabled', true);
            $.ajax({
                type: "POST",
                url: "assets/includes/process-modal.php",
                data: {
                    submit: "submit",
                    userInput: userData,
                    radioBtns: radioBtns
                },
                success: function (result) {
                    console.log(result);
                    $('#form-submit').attr('disabled', false);
                    $('#wizard-back').attr('disabled', false);
                    if (result == "No Errors") {
                        $('#confirmation').hide();
                        $('#form-submit').hide();
                        $('#purchase').show();
                        $('#payment').show();
                        handler.open();
                        // allow user to open payment if they closed it
                        document.getElementById('purchase').addEventListener("click", function () {
                            handler.open();
                        });
                        $('#wizard-back').removeClass("confirmation-back").addClass("payment-back");
                        $('#wizard-next').removeClass("confirmation-next").addClass("payment-next").hide();

                    } else {
                        $('#errors').show();
                        $('#confirmation').hide();
                        $('#form-submit').hide();
                        $.each(JSON.parse(result), function (i, val) {
                            $('#errorResult').append(document.createTextNode(val),
                                document.createElement("br"));
                        });
                    }
                }
            });
        }
    });

    // When the user clicks the back button
    $('#wizard-back').click(function () {
        $('#validation').hide();
        var backBtnClass = document.getElementById("wizard-back").className;

        if (backBtnClass == "two-back-a") {
            $('#two').hide();
            $('#one').show();
            $('#wizard-back').hide().removeClass("two-back-a").addClass("one-back");
            $('#wizard-next').removeClass("two-next-a").addClass("one-next");

        } else if (backBtnClass == "two-back-b") {
            $('#b').hide();
            $('#a').show();
            $('#wizard-back').removeClass("two-back-b").addClass("two-back-a");
            $('#wizard-next').removeClass("two-next-b").addClass("two-next-a");
        } else if (backBtnClass == "two-back") {
            $('#c').hide();
            $('#b').show();
            $('#wizard-back').removeClass("two-back").addClass("two-back-b");
            $('#wizard-next').removeClass("two-next").addClass("two-next-b");
        } else if (backBtnClass == "primary-residence-back") {
            $('#primary-residence').hide();
            $('#two').show();
            $('#wizard-back').removeClass("primary-residence-back").addClass("two-back");
            $('#wizard-next').removeClass("primary-residence-next").addClass("two-next");

        } else if (backBtnClass == "three-back") {
            $('#three').hide();
            $('#primary-residence').show();
            $('#wizard-back').removeClass("three-back").addClass("primary-residence-back");
            $('#wizard-next').removeClass("three-next").addClass("primary-residence-next");

        } else if (backBtnClass == "four-back") {
            $('#four').hide();
            $('#three').show();
            $('#wizard-back').removeClass("four-back").addClass("three-back");
            $('#wizard-next').removeClass("four-next").addClass("three-next");

        } else if (backBtnClass == "adopted-back") {
            $('#adopted').hide();
            $('#four').show();
            $('#wizard-back').removeClass("adopted-back").addClass("four-back");
            $('#wizard-next').removeClass("adopted-next").addClass("four-next");

        } else if (backBtnClass == "dependent-info-back") {
            $('#dependent-info').hide();
            $('#adopted').show();
            $('#wizard-back').removeClass("dependent-info-back").addClass("adopted-back");
            $('#wizard-next').removeClass("dependent-info-next").addClass("adopted-next");
        } else if (backBtnClass == "minors-back-a") {
            $('#minors').hide();
            $('#dependent-info').show();
            $('#wizard-back').removeClass("minors-back-a").addClass("dependent-info-back");
            $('#wizard-next').removeClass("minors-next-a").addClass("dependent-info-next");
        } else if (backBtnClass == "minors-back") {
            $('#alt-guardian').hide();
            $('#guardian').show();
            $('#wizard-back').removeClass("minors-back").addClass("minors-back-a");
            $('#wizard-next').removeClass("minors-next").addClass("minors-next-a");
        } else if (backBtnClass == "predeceased-back") {
            $('#predeceased').hide();
            if (hasDependent == 'yes') {
                if (minors) {
                    $('#minors').show();
                    $('#wizard-back').removeClass("predeceased-back").addClass("minors-back");
                    $('#wizard-next').removeClass("predeceased-next").addClass("minors-next");
                } else {
                    $('#dependent-info').show();
                    $('#wizard-back').removeClass("predeceased-back").addClass("dependent-info-back");
                    $('#wizard-next').removeClass("predeceased-next").addClass("dependent-info-next");
                }
            } else {
                $('#four').show();
                $('#wizard-back').removeClass("predeceased-back").addClass("four-back");
                $('#wizard-next').removeClass("predeceased-next").addClass("four-next");
            }
        }
        else if (backBtnClass == "predeceased-info-back") {
            $('#predeceased-info').hide();
            $('#predeceased').show();
            $('#wizard-back').removeClass("predeceased-info-back").addClass("predeceased-back");
            $('#wizard-next').removeClass("predeceased-info-next").addClass("predeceased-next");
        }
        else if (backBtnClass == "wasiyya-bequest-back") {
            $('#wasiyya-bequest').hide();
            if (predeceased) {
                $('#predeceased-info').show();
                $('#wizard-back').removeClass("wasiyya-bequest-back").addClass("predeceased-info-back");
                $('#wizard-next').removeClass("wasiyya-bequest-next").addClass("predeceased-info-next");
            } else {
                $('#predeceased').show();
                $('#wizard-back').removeClass("wasiyya-bequest-back").addClass("predeceased-back");
                $('#wizard-next').removeClass("wasiyya-bequest-next").addClass("predeceased-next");
            }

        }
        else if (backBtnClass == "bequest-info-back") {
            $('#bequest-info').hide();
            $('#wasiyya-bequest').show();
            $('#wizard-back').removeClass("bequest-info-back").addClass("wasiyya-bequest-back");
            $('#wizard-next').removeClass("bequest-info-next").addClass("wasiyya-bequest-next");

        } else if (backBtnClass == "five-back-a") {
            $('#five').hide();
            if (wasiyyaBequest == 'yes') {
                $('#bequest-info').show();
                $('#wizard-back').removeClass("five-back-a").addClass("bequest-info-back");
                $('#wizard-next').removeClass("five-next-a").addClass("bequest-info-next");
            } else {
                $('#wasiyya-bequest').show();
                $('#wizard-back').removeClass("five-back-a").addClass("wasiyya-bequest-back");
                $('#wizard-next').removeClass("five-next-a").addClass("wasiyya-bequest-next");
            }
        } else if (backBtnClass == "five-back") {
            $('#alt-personalRepresentative-info').hide();
            $('#personalRepresentative-info').show();
            $('#form-submit').hide();
            $('#wizard-back').removeClass("five-back").addClass("five-back-a");
            $('#wizard-next').removeClass("five-next").addClass("five-next-a");

        } else if (backBtnClass == "poa-back") {
            $('#poa').hide();
            $('#five').show();
            $('#wizard-back').removeClass("poa-back").addClass("five-back");
            $('#wizard-next').removeClass("poa-next").addClass("five-next").show();
        } else if (backBtnClass == "confirmation-back") {
            $('#confirmation').hide();
            $('#form-submit').hide();
            $('#poa').show();
            $('#user-input').empty();
            $('#errorResult').empty();
            $('#errors').hide();
            $('#wizard-back').removeClass("confirmation-back").addClass("poa-back");
            $('#wizard-next').removeClass("confirmation-next").addClass("poa-next").show();
        } else if (backBtnClass == "payment-back") {
            handler.close();
            $('#purchase').hide();
            $('#payment').hide();
            $('#poa').show();
            $('#wizard-back').removeClass("payment-back").addClass("poa-back");
            $('#wizard-next').removeClass("payment-next").addClass("poa-next").show();
        } else if (backBtnClass == "ok") {
            $('#two').hide();
            $('#one').show();
            $('#errors').hide();
            $('#errorResult').empty();
            $('#wizard-back').hide().removeClass("ok").addClass("one-back");
            $('#wizard-next').removeClass("two-next").addClass("one-next").show();
        }
    });

// accept payment through stripe
    var handler = StripeCheckout.configure({
        key: 'pk_test_fP7ulaUBqPVejk3Ap8aZmaxf',
        image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
        locale: 'auto',
        name: 'WasiyyaPlanner',
        description: 'Estate Planning Package',
        billingAddress: true,
        allowRememberMe: false,
        amount: 2000,
        token: function (token, args) {
            // You can access the token ID with `token.id`.
            // Get the token ID to your server-side code for use.
            console.log(token);
            $.ajax({
                url: 'assets/includes/stripe/charge.php',
                type: 'post',
                data: {
                    tokenID: token.id,
                    tokenEmail: token.email,
                    submit: 'submit'
                },
                success: function(data) {
                    console.log(data);
                    if (data == 'success') {
                        console.log("Card successfully charged!");
                        $('#ok').show();
                        $('#result').show();
                        $('#wizard-back').hide();
                        $('#purchase').hide();
                        $('#payment').hide();
                    }
                    else {
                        console.log("Success Error!");
                    }

                },
                error: function(data) {
                    console.log("Ajax Error!");
                    console.log(data);
                }
            }); // end ajax call
        }
    });


    $('#add-child').click(function () {
        if (validateChild(false)) {
            var child;
            child = cFName + " " + cLName + ' ' + cAge;
            children[numOfChildren] = child;
            $('#children').append("<div>" + children[numOfChildren] + "</div>");
            $('#childFirstName').val('');
            $('#childLastName').val('');
            $('#child-age').val('');
            numOfChildren++;
            $('#validation').hide();
        }
    });

    $('#add-predeceased').click(function () {
        if (validateChild(true)) {
            var predeceased;
            predeceased = cFName + " " + cLName;
            predeceasedChildren[numOfPredeceased] = predeceased;
            $('#pdchildren').append("<div>" + predeceasedChildren[numOfPredeceased] + "</div>");
            $('#pdFirstName').val('');
            $('#pdLastName').val('');
            numOfPredeceased++;
            $('#validation').hide();
        }
    });

    $('#add-beneficiary').click(function () {
        $('#validation').hide();
        $('#total-percent-error').hide();
        $('#percent-error').hide();
        if (validateBeneficiary()) {
            var beneficiary;
            beneficiary = benName + " " + benCity + " " + benState + " " +
                benCountry + " " + benPercent;
            beneficiaries[numOfBens] = beneficiary;
            $('#added-beneficiaries').append("<div>" + beneficiaries[numOfBens] + "</div>");
            $('#beneficiary-name').val('');
            $('#beneficiary-city').val('');
            $('#beneficiary-state').val('');
            $('#beneficiary-country').val('');
            $('#beneficiary-percent').val('');
            numOfBens++;
            $('#validation').hide();
        }
    });

    // When the user changes the radio button for spouse
    $('input[name=spouse]').change(function () {
        var value = $('input[name=spouse]:checked').val();
        if (value == 'yes') {
            $('#spouse-info').show();
        } else {
            $('#spouse-info').hide();
        }
    });

    // When the user changes the radio button for predeceased children
    $('input[name=predeceased-child]').change(function () {
        var value = $('input[name=predeceased-child]:checked').val();
        if (value == 'yes') {
            $('#provide-for-predeceased').show();
        } else {
            $('#provide-for-predeceased').hide();
        }
    });

    // When the user changes the radio button for wasiyya bequest
    $('input[name=designate]').change(function () {
        var value = $('input[name=designate]:checked').val();
        if (value == 'yes') {
            $('#bequest-percentage').show();
        } else {
            $('#bequest-percentage').hide();
        }
    });

    var checkAnswers = function () {
        business = $('input[name=business]:checked').val();
        maxAssets = $('input[name=maxAssets]:checked').val();
        realEstate = $('input[name=realEstate]:checked').val();
        providePredeceased = $('input[name=provide-for-predeceased]:checked').val();

        radioBtns['Business'] = business;
        radioBtns['maxAssets'] = maxAssets;
        radioBtns['Real Estate'] = realEstate;
        radioBtns['Provide Predeceased'] = providePredeceased;

        return ((business == 'yes' || maxAssets == 'yes') || (realEstate == 'yes' || providePredeceased == 'yes'));
    };

    var formatInputData = function () {
        $('#user-input').empty();
        for (var field in userData) {
            $('#user-input').append(field + ": " + userData[field] + "</br>");
        }
    };

    var sendReferralEmail = function () {
        formatInputData();
        $.ajax({
            type: "POST",
            url: "assets/includes/process-modal.php",
            data: {
                referral: "referral",
                userInput: userData,
                radioBtns: radioBtns

            },
            success: function (result) {
                if (result != "No Errors") {
                    $('#errors').show();
                    $('#confirmation').hide();
                    $('#wizard-back').show();
                    $.each(JSON.parse(result), function (i, val) {
                        $('#errorResult').append(document.createTextNode(val),
                            document.createElement("br"));
                    });
                } else {
                    $('#referral').show();
                    $('#ok').show();
                }
            }
        });
    };

    var loadJS = function (file) {
        // DOM: Create the script element
        var jsElm = document.createElement("script");
        // set the type attribute
        jsElm.type = "application/javascript";
        // make the script element load file
        jsElm.src = file;
        // finally insert the element to the body element in order to load the script
        document.body.appendChild(jsElm);
    };

    var validateOne = function () {
        fName = $('#fName').val();
        lName = $('#lName').val();
        phoneNum = $('#phone').val();
        email = $('#email').val();
        if (!fName) {
            $('#validation').show();
            $('#fName').focus();
            return false;
        }

        if (!lName) {
            $('#validation').show();
            $('#lName').focus();
            return false;
        }

        if (!validatePhoneNum(phoneNum)) {
            $('#validation').show();
            $('#phone').focus();
            return false;
        }


        if (!validateEmail(email)) {
            $('#validation').show();
            $('#email').focus();
            return false;
        }

        userData["First Name"] = fName;
        userData["Last Name"] = lName;
        userData["Phone Number"] = phoneNum;
        userData["Email"] = email;

        return true;
    };

    var validateRadio = function ($input) {
        if ($input) {
            return true;
        } else {
            $('#validation').show();
            return false;
        }
    };

    var validateThree = function () {
        spouseFName = $('#spouseFirstName').val();
        spouseLName = $('#spouseLastName').val();

        if (!spouseFName) {
            $('#validation').show();
            $('#spouseFirstNameName').focus();
            return false;
        }

        if (!spouseLName) {
            $('#validation').show();
            $('#spouseLastName').focus();
            return false;
        }

        userData["Spouse First Name"] = spouseFName;
        userData["Spouse Last Name"] = spouseLName;

        return true;
    };

    var validateFive = function (alternate) {
        if (!alternate) {
            personalRepFName = $('#personal-rep-fName').val();
            personalRepLName = $('#personal-rep-LName').val();
            personalRepPhone = $('#personal-rep-phoneNum').val();
            personalRepEmail = $('#personal-rep-email').val();
            if (!personalRepFName) {
                $('#validation').show();
                $('#personal-rep-fName').focus();
                return false;
            }

            if (!personalRepLName) {
                $('#validation').show();
                $('#personal-rep-LName').focus();
                return false;
            }

            if (!validatePhoneNum(personalRepPhone)) {
                $('#validation').show();
                $('#personal-rep-phoneNum').focus();
                return false;
            }

            if (!validateEmail(personalRepEmail)) {
                $('#validation').show();
                $('#personal-rep-email').focus();
                return false;
            }

            userData["Personal Rep First Name"] = personalRepFName;
            userData["Personal Rep Last Name"] = personalRepLName;
            userData["Personal Rep Email"] = personalRepEmail;
            userData["Personal Rep Phone Number"] = personalRepPhone;
        } else {
            personalRepFName = $('#alt-personal-rep-fName').val();
            personalRepLName = $('#alt-personal-rep-LName').val();
            personalRepPhone = $('#alt-personal-rep-phoneNum').val();
            personalRepEmail = $('#alt-personal-rep-email').val();
            if (!personalRepFName) {
                $('#validation').show();
                $('#alt-personal-rep-fName').focus();
                return false;
            }

            if (!personalRepLName) {
                $('#validation').show();
                $('#alt-personal-rep-LName').focus();
                return false;
            }

            if (!validatePhoneNum(personalRepPhone)) {
                $('#validation').show();
                $('#alt-personal-rep-phoneNum').focus();
                return false;
            }

            if (!validateEmail(personalRepEmail)) {
                $('#validation').show();
                $('#alt-personal-rep-email').focus();
                return false;
            }

            userData["Alt Personal Rep First Name"] = personalRepFName;
            userData["Alt Personal Rep Last Name"] = personalRepLName;
            userData["Alt Personal Rep Email"] = personalRepEmail;
            userData["Alt Personal Rep Phone Number"] = personalRepPhone;
        }

        return true;
    };

    var validatePOA = function () {
        aifFName = $('#aif-fName').val();
        aifLName = $('#aif-LName').val();
        aifEmail = $('#aif-email').val();
        aifPhone = $('#aif-phoneNum').val();

        if (!aifFName) {
            $('#validation').show();
            $('#aif-fName').focus();
            return false;
        }

        if (!aifLName) {
            $('#validation').show();
            $('#aif-LName').focus();
            return false;
        }

        if (!validateEmail(aifEmail)) {
            $('#validation').show();
            $('#aif-email').focus();
            return false;
        }

        if (!validatePhoneNum(aifPhone)) {
            $('#validation').show();
            $('#aif-phoneNum').focus();
            return false;
        }

        userData["Attorney-in-fact First Name"] = aifFName;
        userData["Attorney-in-fact Last Name"] = aifLName;
        userData["Attorney-in-fact Email"] = aifEmail;
        userData["Attorney-in-fact Phone Number"] = aifPhone;

        return true;
    };

    var validateGaurdian = function (alternate) {
        if (!alternate) {
            guardianFName = $('#guardian-Fname').val();
            guardianLName = $('#guardian-Lname').val();
            guardianCity = $('#guardian-city').val();
            guardianState = $('#guardian-state').val();
            guardianCountry = $('#guardian-country').val();
            if (!guardianFName) {
                $('#validation').show();
                $('#guardian-Fname').focus();
                return false;
            }
            if (!guardianLName) {
                $('#validation').show();
                $('#guardian-Lname').focus();
                return false;
            }
            if (!guardianCity) {
                $('#validation').show();
                $('#guardian-city').focus();
                return false;
            }
            if (!guardianState) {
                $('#validation').show();
                $('#guardian-state').focus();
                return false;
            }
            if (!guardianCountry) {
                $('#validation').show();
                $('#guardian-country').focus();
                return false;
            }

            userData['Guardian First Name'] = guardianFName;
            userData['Guardian Last Name'] = guardianLName;
            userData['Guardian City'] = guardianCity;
            userData['Guardian State'] = guardianState;
            userData['Guardian Country'] = guardianCountry;

            return true;
        } else {
            altGuardianFName = $('#alt-guardian-Fname').val();
            altGuardianLName = $('#alt-guardian-Lname').val();
            altGuardianCity = $('#alt-guardian-city').val();
            altGuardianState = $('#alt-guardian-state').val();
            altGuardianCountry = $('#alt-guardian-country').val();

            if (!altGuardianFName) {
                $('#validation').show();
                $('#alt-guardian-Fname').focus();
                return false;
            }
            if (!altGuardianLName) {
                $('#validation').show();
                $('#alt-guardian-Lname').focus();
                return false;
            }
            if (!altGuardianCity) {
                $('#validation').show();
                $('#alt-guardian-city').focus();
                return false;
            }
            if (!altGuardianState) {
                $('#validation').show();
                $('#alt-guardian-state').focus();
                return false;
            }
            if (!altGuardianCountry) {
                $('#validation').show();
                $('#alt-guardian-country').focus();
                return false;
            }

            userData['Alt-Guardian First Name'] = altGuardianFName;
            userData['Alt-Guardian Last Name'] = altGuardianLName;
            userData['Alt-Guardian City'] = altGuardianCity;
            userData['Alt-Guardian State'] = altGuardianState;
            userData['Alt-Guardian Country'] = altGuardianCountry;
            return true;
        }
    };

    var validateChild = function (addPredeceased) {
        if (!addPredeceased) {
            cFName = $('#childFirstName').val();
            cLName = $('#childLastName').val();
            cAge = $('#child-age').val();
            if (!cAge) {
                $('#validation').show();
                $('#child-age').focus();
                return false;
            }
            if (parseFloat(cAge) < 18) {
                minors = true;
                radioBtns['Minors'] = 'yes';
            }
        } else {
            cFName = $('#pdFirstName').val();
            cLName = $('#pdLastName').val();
        }


        if (!cFName) {
            $('#validation').show();
            $('#childFirstName').focus();
            return false;
        }
        if (!cLName) {
            $('#validation').show();
            $('#childLastName').focus();
            return false;
        }

        return true;
    };
    var validateBequestPercent = function () {
        var percent = $('#bequest-percent').val();
        if (!percent) {
            $('#validation').show();
            $('#bequest-percent').focus();
            return false;
        }
        if ((parseFloat(percent) >= 33.001) || (parseFloat(percent) <= 0)) {
            $('#bequest-percent-error').show();
            $('#bequest-percent').focus();
            return false;
        }

        $('#bequest-percent-error').hide();
        radioBtns['Wasiyya Percent'] = percent;
        return true;

    };


    var validatePredeceased = function () {
        if (predeceased && numOfPredeceased > 0) {
            return true;
        } else if (!predeceased) {
            numOfChildren = 0;
            predeceasedChildren.empty();
            return true;
        }
        $('#validation').show();
        return false;

    };

    var validateBeneficiary = function () {
        benName = $('#beneficiary-name').val();
        benCity = $('#beneficiary-city').val();
        benState = $('#beneficiary-state').val();
        benCountry = $('#beneficiary-country').val();
        benPercent = $('#beneficiary-percent').val();

        if (!benName) {
            $('#validation').show();
            $('#beneficiary-name').focus();
            return false;
        }
        if (!benCity) {
            $('#validation').show();
            $('#beneficiary-city').focus();
            return false;
        }
        if (!benState) {
            $('#validation').show();
            $('#beneficiary-state').focus();
            return false;
        }
        if (!benCountry) {
            $('#validation').show();
            $('#beneficiary-country').focus();
            return false;
        }
        if (!benPercent || benPercent <= 0) {
            $('#validation').show();
            $('#beneficiary-percent').focus();
            return false;
        }

        if (totalBenPercent + parseFloat(benPercent) > 100) {
            $('#percent-error').show();
            return false;
        } else {
            $('#percent-error').hide();
            totalBenPercent += parseFloat(benPercent);
        }

        userData['Beneficiary Name'] = benName;
        userData['Beneficiary City'] = benCity;
        userData['Beneficiary State'] = benState;
        userData['Beneficiary Country'] = benCountry;
        userData['Beneficiary Percent'] = benPercent;

        return true;
    };

    var validateBequestInfo = function () {
        if (totalBenPercent != 100) {
            $('#total-percent-error').show();
            $('#beneficiary-name').focus();
            return false;
        } else {
            $('#total-percent-error').hide();
            return true;
        }
    }

    // check for valid phone number entry
    var validatePhoneNum = function(phone)
    {
        var phoneNumberPattern = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
        return phoneNumberPattern.test(phone);
    }

    // check for valid e-mail address entry
    var validateEmail = function(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

});