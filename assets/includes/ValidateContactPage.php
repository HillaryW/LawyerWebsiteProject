<?php
/*
 *  Team Red Hot Chili Jellos
 *  Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
 *  File: ValidataContactPage.php
 *  Purpose: This file processes the CAPTCHA on the contact.php page.
 */

//Validate Captcha
if (isset($_POST['submit']) && !empty($_POST['submit'])):
    //validate form
    if (!empty($_POST['name']) && (!empty($_POST['email']) && !empty($_POST['message']))):
        $name = $_POST['name'];
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)):
            $errMsg = "Invalid Email";
        else:
            $email = $_POST['email'];
            $message = $_POST['message'];
            if (isset($_POST['grecaptcha']) && !empty($_POST['grecaptcha'])):
                //your site secret key
                $secret = '6Ldo8BMUAAAAAMql_tzEapQuNmtDbkoDDw1TqYrd';
                //get verify response data
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' .
                    $secret . '&response=' . $_POST['grecaptcha']);
                $responseData = json_decode($verifyResponse);
                if ($responseData->success):
                    //contact form submission code
                    $to = 'hwagoner11@outlook.com';
                    $subject = 'New contact form have been submitted';
                    $htmlContent = "
                        <h1>Contact request details</h1>
                        <p><b>Name: </b>" . $name . "</p>
                        <p><b>Email: </b>" . $email . "</p>
                        <p><b>Message: </b>" . $message . "</p>
                    ";
                    // Always set content-type when sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    // More headers
                    $headers .= 'From:' . $name . ' <' . $email . '>' . "\r\n";
                    //send email
                    @mail($to, $subject, $htmlContent, $headers);

                    $errMsg = 'Your contact request have submitted successfully.';
                else:
                    $errMsg = 'Robot verification failed, please try again.';
                endif;
            else:
                $errMsg = 'Please click on the reCAPTCHA box.';
            endif;
        endif;
    else:
        $errMsg = "Please fill out all fields in form";
    endif;
else:
    $errMsg = "Please try your submission again";
endif;
echo $errMsg;
?>