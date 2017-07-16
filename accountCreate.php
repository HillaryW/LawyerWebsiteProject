<?php
session_start();
if (isset($_SESSION['user'])) {
    header("location:docWizard.php");
}
include 'assets/includes/header.inc.php';
?>
    <!--
        Team Red Hot Chili Jellos
        Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
        File: login.php
        Purpose: This file is the create user account form to enter first name, last name, username and password
        to access generateDocument.php modal to purchase documents.
    -->

    <title>Register</title>

<?php
include 'assets/includes/navbar.inc.php';
?>

    <link rel="stylesheet" href="assets/css/login.css">

    <!-- Main -->
    <div id="main">

        <!-- Two -->
        <section id="two">
            <div class="inner">
                <header class="major">
                    <h1>Create Account</h1>
                </header>

                <div id="error-Message">

                </div>

                <!-- account create form -->
                <form method="post" action="">

                    <div class="field">
                        <label for="firstname">First Name</label>
                        <input type="text" placeholder="Enter First Name" name="firstname" id="firstname" required/>
                    </div>

                    <div class="field">
                        <label for="lastname">Last Name</label>
                        <input type="text" placeholder="Enter Last Name" name="lastname" id="lastname" required/>
                    </div>

                    <div class="field">
                        <label for="phone">Phone Number</label>
                        <input type="text" placeholder="555-555-5555" name="phone" id="phone" required/>
                    </div>

                    <div class="field">
                        <label for="email">E-Mail</label>
                        <input type="text" placeholder="Enter E-Mail" name="email" id="email" required/>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" placeholder="Enter Password" name="password" id="password" required/>
                    </div>

                    <div class="field">
                        <label for="password2">Confirm Password</label>
                        <input type="password" placeholder="Re-enter Password" name="password2" id="password2" required/>
                    </div>

                    <div class="actions">
                        <input type="submit" name="submit" id="submit" value="Create Account" class="special"/>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script src='assets/js/accountCreate.js'></script>
<?php
include_once 'assets/includes/footer.inc.php';
?>