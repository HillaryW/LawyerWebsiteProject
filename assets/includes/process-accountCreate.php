<?php
/**
 * Team Red Hot Chili Jellos
 * Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
 * File: process-accountCreate.php
 * Purpose: This file is for processing users creating an account.
 */

session_start();
require_once '/home/attorneyatlaw/dbcon.php';
require_once 'passwordCheck.php';

$result = 'An error has occured, please try again later';


if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    //reset result variable
    $result = "";

    //user account variables
    $email = "";
    $firstname = "";
    $lastname = "";
    $phone = "";
    $password = "";
    $password2 = "";
    $hashedPassword = "";

    $valid = false;


    //validate fields
    if (empty($_POST['fName'])) {
        $result .= "Please enter First Name </br>";
    } else {
        $firstname = $_POST['fName'];
    }

    if (empty($_POST['lName'])) {
        $result .= "Please enter Last Name </br>";

    } else {
        $lastname = $_POST['lName'];
    }

    if (!empty($_POST['email'])) {
        //validate email as email address
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = $_POST['email'];
        } else {
            $result = "Invalid email, must be a valid email address";
        }
    }

    if (empty($_POST['phone'])) {
        $result .= "Please enter Phone Number </br>";
    } else {
        $phone = $_POST['phone'];
    }

    if (empty($_POST['password'])) {
        $result .= "Please enter password </br>";
    } else {
        $password = $_POST['password'];
    }

    if (empty($_POST['password2'])) {
        $result .= "Please confirm your password </br>";
    } else {
        $password2 = $_POST['password2'];
    }


    //check for no missing fields
    if (empty($result)) {
        // checking passwords are the same
        if ($password != $password2) {
            $result = 'Your passwords do not match.';
        } else {
            $valid = true;
        }
    }


    if ($valid) {
        $dbcon = new DbConn();
        $conn = $dbcon->getConnection();

        //check to make sure that user doesn't exist already
        $query = "SELECT username FROM users WHERE username = :email";

        // prepare the statement
        $statement = $conn->prepare($query);

        //bind parameter
        $statement->bindParam(':email', $email, PDO::PARAM_STR);

        //execute the statement
        if ($statement->execute()) {
            $results = $statement->fetchAll();
            if (count($results) > 0) {
                $userExists = true;
            }
        }
        //if the user doesn't exist create user
        if (!$userExists) {

            //generate salt
            $salt = generateSalt();

            //hash password
            $hashedPassword = generateHash($_POST['password'], $salt);

            // Define the query
            $query = "INSERT INTO users (firstname, lastname, username, passcode, salt) VALUES 
                      (:firstname, :lastname, :email, :passcode, :salt)";

            // prepare the statement
            $statement = $conn->prepare($query);

            //bind parameters
            $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':passcode', $hashedPassword, PDO::PARAM_STR);
            $statement->bindParam(':salt', $salt, PDO::PARAM_STR);

            //execute the statement
            if ($statement->execute()) {
                $_SESSION['user'] = $email;
                $result = 'logged in';
            }
        } else {
            $result = "E-mail is already in use";
        }
    }
}
unset($row);
$conn = null;
echo $result;
?>