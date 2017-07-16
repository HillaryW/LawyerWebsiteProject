<?php
require_once '/home/attorneyatlaw/dbcon.php';
/**
 * Created by PhpStorm.
 * User: Hillary
 * Date: 5/23/2017
 * Time: 11:16 PM
 */

if (isset($_SESSION['user']) || isset($_SESSION['admin'])){
    $email;

    $dbcon = new DbConn();
    $conn = $dbcon->getConnection();

    // set email address of user or admin depending on who is logged in
    if (isset($_SESSION['user'])) {
        $email = $_SESSION['user'];
    } else {
        $email = $_SESSION['admin'];
    }

        $query = "SELECT username, firstname, lastname FROM users WHERE username = :email";


    // prepare the statement
    $statement = $conn->prepare($query);

    //bind parameter
    $statement->bindParam(':email', $email, PDO::PARAM_STR);

    $statement->execute();

    $row = $statement->fetch();
}
