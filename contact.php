<?php
include 'assets/includes/header.inc.php';
?>

<!--
    Team Red Hot Chili Jellos
    Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
    File: contact.php
    Purpose: This file contains Arthur DeLong's contact information
    and a contact form for the user to send a message to Arthur DeLong.
-->

    <title>Contact Arthur</title>
    <meta name="description" content="Contact Arthur using the form, call, or e-mail">

<?php
include 'assets/includes/navbar.inc.php';
?>

    <link rel="stylesheet" href="assets/css/form.css">

    <!-- Main -->
    <div id="main" class="alt">

        <!-- One -->
        <section id="one">
            <div class="inner">
                <header class="major">
                    <h1>Contact Arthur</h1>
                </header>
            </div>
        </section>

    </div>

    <!-- Contact Form-->
    <section id="contact">
        <div class="inner">
            <section>
                <form id="contact-form" method="post" action="">
                    <div class="field half first">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value ="<?php echo $name; ?>"required/>
                    </div>
                    <div class="field half">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $email; ?>"required/>
                    </div>
                    <div class="field">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" rows="6" required><?php echo $message; ?></textarea>

                    </div>

                    <div class="g-recaptcha" data-sitekey="6Ldo8BMUAAAAACw716jeK8UmL-CqSWC8uPtqonHI">
                    </div>

                    <ul class="actions">
                        <li><input type="button" id = 'submit' name="submit" value="Send Message" class="special"/></li>
                        <li><input type="reset" value="Clear"/></li>
                    </ul>
                </form>
            </section>

            <!-- Contact info -->

            <section class="split">
                <section>
                    <div class="contact-method">
                        <span class="icon alt fa-envelope"></span>
                        <h3>Email</h3>
                        <a href="#">arthur@richardlevenson.com</a>
                    </div>
                </section>
                <section>
                    <div class="contact-method">
                        <span class="icon alt fa-phone"></span>
                        <h3>Phone</h3>
                        <span>(253) 572-4109</span>
                    </div>
                </section>
                <section>
                    <div class="contact-method">
                        <span class="icon alt fa-home"></span>
                        <h3>Address</h3>
                        <br>621 Pacific Ave<br/>
                        Suite 209</br>
                        Tacoma, WA 98402</span>
                    </div>
                </section>
            </section>
        </div>
    </section>

    <section id="bios">

        <h1>Arthur DeLong</h1>
        <p>Arthur DeLong practices business and commercial transactional law, and advises clients on matters
            relating to business formation, capital formation (equity and debt offerings, including venture
            capital deals, private placement offerings, crowdfunding and small-equity offerings), structured
            financial transactions and estate planning. His practice also spans commercial real estate,
            international trade and intellectual property law. Arthur is a published author in the
            field of Islamic Finance, and also advises on Sharia-compliant structured transactions and
            Islamic wills.
            <br><br>
            In addition to his law degree, Arthur holds a Master's Degree in International Business from
            Albers School of Business, and a BA in Diplomacy/World Affairs and Spanish from Occidental
            College.
            Arthur speaks fluent Spanish and enjoys studying Arabic in his free time. Although not his
            primary
            area of practice, Arthur also does significant pro bono work on international human rights
            issues
            with the Iraqi Refugee Assistance Project.</p>
        <hr class="major"/>

    </section>

<script src = 'assets/js/contact.js'></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-97345514-1', 'auto');
        ga('send', 'pageview');

    </script>

<?php
include_once 'assets/includes/footer.inc.php';
?>