<?php
/*
 *  Team Red Hot Chili Jellos
 *  Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
 *  File: header.inc.php
 *  Purpose: This file is the beginning of the HTML website pages.
 */

session_start();

if (isset($_SESSION['user'])) {
    header("location:docWizard.php");
}elseif (isset($_SESSION['admin'])) {
    header("location:post.php");
}
?>
<!--The MIT License (MIT)

Copyright (c)
2017
    Hillary Wagoner, Ramona Graham, Josh Lyon, Chris Barbour

        Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
        documentation files (the "Software"), to deal in the Software without restriction, including without limitation
        the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and
        to permit persons to whom the Software is furnished to do so, subject to the following conditions:

        The above copyright notice and this permission notice shall be included in all copies or substantial portions of
        the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO
        THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
        AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
        CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
        DEALINGS IN THE SOFTWARE.-->



<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5SLCT2S');</script>
    <!-- End Google Tag Manager -->

    <!-- JQuery Include -->
    <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous">
    </script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <!--[if lte IE 8]>
    <script src="assets/js/ie/html5shiv.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="assets/css/main.css"/>
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ie9.css"/>
    <![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="assets/css/ie8.css"/>
    <![endif]-->

    <!-- Custom Navigation Bar Stylesheet -->
    <link rel="stylesheet" href="assets/css/navbar.css"/>

    <!-- Hide Logout Button until active -->
    <link rel="stylesheet" href="assets/css/LogoutButton.css"/>

    <!-- Custom Login Form Stylesheet -->
    <link rel="stylesheet" href="assets/css/login.css"/>

    <title>Login</title>
</head>
<body>
<!--
    Team Red Hot Chili Jellos
    Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
    File: login.php
    Purpose: This file is the login form to enter a username and password
    to access postblog.php to create blogs.
-->


    <!-- Main -->
    <div id="main">

        <!-- Two -->
        <section>
            <div class="inner">
                <header class="major">
                    <h1>Log In</h1>
                </header>

                <div id="error-Message">

                </div>

                <!-- login form -->
                <form method= "">

                    <div class="field">
                        <label for="email">E-mail</label>
                        <input type="text" placeholder="Enter E-Mail" name="email" id="email" required/>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" placeholder="Enter Password" name="password" id="password" required/>
                    </div>

                    <div class="actions">
                        <input type="submit" name="submit" id="submit" value="Log In"/> &nbsp;&nbsp;&nbsp;
                        <button id="forgot-pw">Forgot Password</button> &nbsp;&nbsp;&nbsp;
                        <button id="create-acct" >Create Account</button>
                    </div>
                </form>
            </div>
        </section>
    </div>


    <script src='assets/js/login.js'></script>
<footer id="login-footer">
    <div class="inner">
        <ul class="icons">
            <li><a target="_blank" href="http://www.twitter.com" class="icon alt fa-twitter">
                    <span class="label">Twitter</span></a></li>
            <li><a target="_blank" href="http://www.facebook.com" class="icon alt fa-facebook">
                    <span class="label">Facebook</span></a>
            </li>
            <li><a target="_blank" href="http://www.linkedin.com" class="icon alt fa-linkedin">
                    <span class="label">LinkedIn</span></a>
            </li>
            <li><a class="copyright" href="login">
                    <span>&copy; 2017</span></a>
            </li>
        </ul>
    </div>
</footer>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<!--[if lte IE 8]>
<script src="assets/js/ie/respond.min.js"></script><![endif]-->
<script src="assets/js/main.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script src="assets/js/navbar.js"></script>
<script src="assets/js/logout.js"></script>
<script src="assets/js/modal.js"></script>

</div>
</body>
</html>