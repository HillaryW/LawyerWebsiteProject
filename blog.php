<?php
include 'assets/includes/header.inc.php';
require_once '/home/attorneyatlaw/dbcon.php';
include_once 'assets/includes/process-blog.php';

/*
 *  Team Red Hot Chili Jellos
 *  Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
 *  File: blog.php
 *  Purpose: This file displays the blogs.
 */

$urlstuff = $_SERVER["QUERY_STRING"];
if ($urlstuff != false) {
    $id = substr($urlstuff, 8);

    $blog =  new BlogProcessing;
    $editblog = $blog->deleteBlog($id);
}
?>


    <title>Arthur DeLong Blogs</title>
    <meta name="description" content="Arthur's blogs are about relevant information regarding real estate,
    business organization, estate planning, or commercial laws">

<?php
include 'assets/includes/navbar.inc.php';
?>
<link rel="stylesheet" href="assets/css/blog.css"/>
    <!-- Banner -->
    <section id="banner" class="style2">
        <div class="inner">
            <span class="image">
                <img src="assets/images/blog.jpg" alt="Blog Words"/>
            </span>
            <header class="major">
                <h1>Blog</h1>
            </header>
            <div class="content">
            </div>
        </div>
    </section>

    <!-- Main -->
    <div id="main">
        <!-- One -->
        <section id="one">
            <div class="inner">
                <section>
                    <?php
                    //create new instance of class
                    $retrieveBlogs = new BlogProcessing();

                    //get result of getBlogs function
                    $result = $retrieveBlogs->getBlogs();

                    //display all blogs in Database
                    foreach ($result as $row) {
                        echo "<div id='".$row['blog_id']."'>";
                        echo "</div>";
                        echo "<br>";
                        echo "<br>";
                        echo "<div class='blogRow'>";
                        echo "<div class='title'>";
                        echo '<h1>' . $row['title'] . '</h1>';
                        echo "</div>";
                        echo "<div class='contentPost'>";
                        echo '<p>';

                        if($row['image'] != null) {
                            echo "<div class='image'>";
                            echo "<img src='assets/includes/" . $row['image'] . "'" . "alt=''/>";
                            echo "</div>";
                        }
                        echo $row['content'] . "</p>";
                        if (isset($_SESSION['admin'])) {
                            echo "<ul class='blogIcons'>";
                            echo '<li><a href="post.php?blog_id=' . $row['blog_id'].'" class="icon alt fa-pencil"><span> Edit</span></a><br>';
                            echo '<li><a href="blog.php?blog_id=' . $row['blog_id'].'" class="icon alt fa-trash"><span> Delete</span></a>';
                            echo '</ul>';
                        }
                        echo "</div>";
                        echo "</div>";
                        echo '<hr class="major">';


                    }
                    ?>
                </section>
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