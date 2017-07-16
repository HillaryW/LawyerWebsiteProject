<?php
/*
 *  Team Red Hot Chili Jellos
 *  Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
 *  File: process-blog.php
 *  Purpose: This file contains the BlogProcessing class which has functions
 *  to insert a blog into the database (attorney_db database and blog table),
 *  upload image, retrieve the blogs, retrieve a single blog, and delete a blog.
 *
 */

session_start();
require_once '/home/attorneyatlaw/dbcon.php';
require_once 'BlogProcessing.php';
$_SESSION['file'];
ob_start();

//check blog post inputs and send to post blog function
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['title']) && !empty($_POST['content'])) {
        $blogprocessing = new BlogProcessing();
        if ($_FILES['uploadImage']['size'] > 0 && $_FILES['uploadImage']['error'] == 0){
            $image = $_FILES['uploadImage'];
        } else {
            $image = null;
        }
        if ($_SESSION['update'] == 'update') {
            $blogprocessing->updateImage($_POST['id'], $_POST['title'], $_POST['content'], $image);
        } else {
            $blogprocessing->postBlogEntry($_POST['title'], $_POST['content'], $image);
        }

    }else {
        $result = "Please fill out title and content";
    }

    $_SESSION['file'] = $result;
    ob_end_clean();
    header('Location: ../../post.php');
}




