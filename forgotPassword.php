<?php
include 'assets/includes/header.inc.php';
?>
<link rel="stylesheet" href="assets/css/login.css">
<?php
include 'assets/includes/navbar.inc.php';
?>
<!-- Main -->
<div id="main">

    <!-- Two -->
    <section id="two">
        <div class="inner">
            <header class="major">
                <h1>Reset Password</h1>
            </header>
            <div id="error-Message">

            </div>
            <form method="post">
                <div class="field">
                    <label for="email">E-Mail</label>
                    <input type="text" placeholder="Enter E-Mail" name="email" id="email" required/>
                </div>
                <input type="submit" name="submit" id="submit" value="Reset"/> &nbsp
            </form>
        </div>
    </section>
</div>

<script src="assets/js/forgotPassword.js">

<?php
include_once 'assets/includes/footer.inc.php';
?>
