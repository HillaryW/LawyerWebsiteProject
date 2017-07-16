<?php
include 'assets/includes/header.inc.php';

/*
 *  Team Red Hot Chili Jellos
 *  Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
 *  File: services.php
 *  Purpose: This file has the list of services Arthur DeLong provides.
 */
?>

    <title>Arthur DeLong Law Practice Areas</title>
    <meta name="description" content="Arhtur DeLong specializes in Estate planning, Business orgainzation law,
    Commercial Transaction law, and Real Estate law">

<?php
include 'assets/includes/navbar.inc.php';
?>
    <!-- Banner -->
    <section id="banner" class="style2">
        <div class="inner">
            <span class="image">
                <img src="assets/images/tacomaskyline.jpg" alt="Tacoma Skyline"/>
            </span>
            <header class="major">
                <h1>Areas Of Expertise</h1>
            </header>
            <div class="content">
            </div>
        </div>
    </section>

    <!-- Main -->
    <div id="main">

        <!-- One - to keep the space between the banner and page content -->
        <section>
            <div class="inner">
            </div>
        </section>

        <!-- Two -->
        <section class="spotlights" id="business-organization">
            <section id="realestate">
                <a href="contact.php" class="image">
                    <img src="assets/images/tacomaskyline.jpg" alt="Real Estate" data-position="top center"/>
                </a>
                <div class="content">
                    <div class="inner">
                        <header class="major">
                            <h3>Real Estate</h3>
                        </header>

                        <ul>
                            <li>Commercial real estate transactions</li>
                            <li>Boundary line disputes</li>
                            <li>Adverse possession</li>
                            <li>Easements</li>
                            <li>Covenants</li>
                        </ul>
                        <ul class="actions">
                            <li><a href="contact.php" class="button">Learn more</a></li>
                        </ul>
                    </div>
                </div>
            </section>
            <section id="businessorganization">
                <a href="contact.php" class="image">
                    <img src="assets/images/handscity.jpg" alt="Business Organization" data-position="center center"/>
                </a>
                <div class="content">
                    <div class="inner">
                        <header class="major">
                            <h3>Business Organization</h3>
                        </header>

                        <ul>
                            <li>Business Formation (C-Corp, S-Corp, LLC, Professional Services Organization, 501c3)</li>
                            <li>Purchase and Sale Agreements</li>
                            <li>LLC Agreements</li>
                            <li>Shareholder Agreements</li>
                            <li>Equity Issuance</li>
                            <li>Voting Rights and Proxy Agreements</li>
                        </ul>
                        <ul class="actions">
                            <li><a href="contact.php" class="button">Learn more</a></li>
                        </ul>
                    </div>
                </div>
            </section>
            <section id="estateplanning">
                <a href="contact.php" class="image">
                    <img src="assets/images/children.jpg" alt="Estate Planning" data-position="top center"/>
                </a>
                <div class="content">
                    <div class="inner">
                        <header class="major">
                            <h3>Estate Planning</h3>
                        </header>
                        <ul>
                            <li>Wills</li>
                            <li>Trusts</li>
                            <li>Power of Attorney (Financial and Health)</li>
                            <li>TEDRA Actions</li>
                            <li>Probate Estate</li>
                        </ul>
                        <ul class="actions">
                            <li><a href="contact.php" class="button">Learn more</a></li>
                        </ul>
                    </div>
                </div>
            </section>
            <section id="commercialtransactions">
                <a href="contact.php" class="image">
                    <img src="assets/images/OfficeBuildings.jpg" alt="Commercial Transactions" data-position="25% 25%"/>
                </a>
                <div class="content">
                    <div class="inner">
                        <header class="major">
                            <h3>Commercial Transactions</h3>
                        </header>

                        <ul>
                            <li>Contracts</li>
                            <li>International Trade</li>
                            <li>Uniform Commercial Code</li>
                            <li>International Business Transactions</li>
                            <li>Letters of Credit</li>
                            <li>Mergers and Acquisitions</li>
                            <li>Capital Formation</li>
                            <li>Equity Crowdfunding</li>
                            <li>Angel / Venture Capital Investing</li>
                            <li>Private Placement Offerings</li>
                        </ul>
                        <ul class="actions">
                            <li><a href="contact.php" class="button">Learn more</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </section>
    </div>
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