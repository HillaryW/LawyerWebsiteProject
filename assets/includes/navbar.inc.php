</head>

<!--
*  Team Red Hot Chili Jellos
*  Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
*  File: navbar.inc.php
*  Purpose: This file is the NavBar for the website pages.
-->

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5SLCT2S"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Collapsed Nav Bar Div -->
        <div class="center-span">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a ontouchstart="" id="nav-home" class="button special active" href="index">Home</a></li>
                <li><a ontouchstart="" id="nav-blog" class="button special" href="blog">Blogs</a></li>
                <li><a ontouchstart="" id="nav-doc" class="button special" href="docWizard">Create Documents</a></li>
                <li><a ontouchstart="" id="nav-calendar" class="button special" href="calendar">Book an Appointment!</a></li>
                <li><a ontouchstart="" id="nav-contact" class="button special" href="contact">Contact Arthur</a></li>
                <?php
                if (isset($_SESSION['admin'])) {

                    //show these tabs only when user is logged in
                    echo "<li><a ontouchstart='' id='nav-postblog' class='button special' href='post'>Post Blog</a></li>";
                    echo "<li><a ontouchstart='' id='nav-logout' class='button special'>Logout</a></li>";

                }
                if (isset($_SESSION['user'])) {
                    //show these tabs only when user is logged in
                    echo "<li><a ontouchstart='' id='nav-logout' class='button special'>Logout</a></li>";
                }
                ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<!-- Wrapper -->
<div id="wrapper">
    <!-- Menu -->
