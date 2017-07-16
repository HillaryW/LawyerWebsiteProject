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
                    <h1>Update Password</h1>
                </header>
                <div id="error-Message">

                </div>
                <form method="post">
                    <div class="field">
                        <label for="password">New Password</label>
                        <input type="text" placeholder="New Password" name="password" id="password" required/>
                        <label for="confirm">Confirm New Password</label>
                        <input type="text" placeholder="Confirm New Password" name="confirm" id="confirm" required/>
                    </div>
                    <input type="submit" name="submit" id="submit" value="Reset"/> &nbsp
                </form>
            </div>
        </section>
    </div>

<script src="assets/js/updatePassword.js"></script>
<?php
include_once 'assets/includes/footer.inc.php';
?>