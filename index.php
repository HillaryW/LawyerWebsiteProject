<?php
include 'assets/includes/header.inc.php';
require_once '/home/attorneyatlaw/dbcon.php';
include 'assets/includes/BlogProcessing.php';
?>

<!--
    Team Red Hot Chili Jellos
    Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
    File: index.php
    Purpose: This file contains Arthur DeLong's business categories and links
    to information about each category.
-->

<title>Arthur DeLong</title>
<meta name="description" content="Arthur DeLong is an attorney located in Tacoma, WA who services
    the Puget Sound area. His expertise is real estate law, business organization law, commercial transactions law,
    and estate planning law.">

<?php
include 'assets/includes/navbar.inc.php';

$blogProcessing = new BlogProcessing();
$blogs = $blogProcessing->getBlogs();


?>


<!-- Banner -->

<section id="banner" class="major">
    <div class="inner">
            <span class="image">
                    <img src="assets/images/office.jpg" alt="Northern Pacific Office Building"/>
                </span>
        <header class="major">
            <h1>Arthur DeLong, Esq.</h1>
        </header>
        <div class="content">
            <p>Attorney focused on real estate,
                business organization, conventional and faith based estate planning, and commercial transactions.</p>
        </div>
    </div>
</section>

<!-- Main -->
<div id="main">
    <!-- One -->
    <section id="one" class="tiles">
        <?php


        foreach ($blogs as $blog ) {
                echo '<article>';
                echo '<span class="image">';
                echo "<img src='assets/includes/".$blog['image']."' alt='Blog Post Image'/>";
                echo '</span>';
                echo '<header class="major">';
                echo "<h3><a href='blog#".$blog['blog_id']."' class='link'>".$blog['title']."</a></h3>";
                echo '</header>';
                echo '</article>';
            }
        if(count($blogs)%2 == 1){
            echo '<article>';
            echo '<span class="image">';
            echo '<img src="assets/images/office.jpg" alt="Our Team"/>';
            echo '</span>';
            echo '<header class="major">';
            echo '<h3><a href="contact" class="link">About Arthur</a></h3>';
            echo '</header>';
            echo '</article>';
        }
        ?>
    </section>

    <!-- Two -->
    <section id="two">
        <div class="inner">
            <header class="major">
                <h2>Areas of Expertise</h2>
            </header>
            <p>Arthur DeLong is a lawyer based in Tacoma, WA, whose focused on real estate, business
                organization, conventional and faith based estate planning, and commercial transactional law. He has
                many years experience in commercial realestate transactions and real property issues. Mr. DeLong also
                excels at advising businesses during each stage of the business's life cycle, including formation,
                contract disputes, mergers and acquisitions, commercial transactions, security issuances (angel and
                venture capital investment, private placement offerings and small-scale equity crowdfunding), industry
                specific regulatory compliance and business dissolution. He also has experience advising on issues
                ranging from international trade and sharia-compliant transactions to tax issues and estate
                planning.</p>
            <ul class="actions">
                <li><a href="services.php" class="button next">Learn More</a></li>
            </ul>
        </div>
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