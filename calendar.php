<?php
include 'assets/includes/header.inc.php';
?>

<!--
    Team Red Hot Chili Jellos
    Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
    File: index.php
    Purpose: This file contains Arthur DeLong's business categories and links
    to information about each category.
-->

<title>Schedule An Appointment</title>
<meta name="description" content="Schedule a time to meet with Arthur">

<?php
include 'assets/includes/navbar.inc.php';
?>

<iframe src="https://arthurdelong.youcanbook.me/?noframe=true&skipHeaderFooter=true"
id="ycbmiframerhcj-capstone" style="width:100%;height:1000px;border:0px;background-color:transparent;"
frameborder="0" allowtransparency="true">
</iframe><script>window.addEventListener && window.addEventListener(
    "message", function(event){if (event.origin === "https://rhcj-capstone.youcanbook.me")
    {document.getElementById("ycbmiframerhcj-capstone").style.height = event.data + "px";}},
    false);</script>


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