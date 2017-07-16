<?php
/*
 *  Team Red Hot Chili Jellos
 *  Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
 *  File: process-login.php
 *  Purpose: This file has the LoginProcessing class to create a database connection,
 *  and query the database for the username.
 */

session_start();
require_once '/home/attorneyatlaw/dbcon.php';
require_once 'passwordCheck.php';

//check if username and password are not empty and exist
if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $loginprocessing = new LoginProcessing();
        $result = $loginprocessing->checkUserExists($_POST['username'], $_POST['password']);
        echo $result;
    }
}

class LoginProcessing
{
    private $conn;

    //create new db connection
    function __construct()
    {
        $dbcon = new DbConn();
        $this->conn = $dbcon->getConnection();
    }

    //query database for user
    function checkUserExists($username, $password)
    {
        //find user account
        $sql = "SELECT username, passcode, salt, accessLevel, temp FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        $stmt->execute();

        $row = $stmt->fetch();

        //if block for only one user
        if ($row) {
            //validate password
            $hashedPassword = generateHash($password, $row['salt']);

            if (verifyPassword($hashedPassword, $row['passcode'])) {
                    if ($row['accessLevel'] == "admin") {
                        $_SESSION['admin'] = $username;
                    } else if ($row['accessLevel'] == "user") {
                        $_SESSION['user'] = $username;
                    }
                    if($row['temp'] == 1){
                        $result = 'tempPW';
                    } else {
                        $result = 'logged in';
                    }
            } else {
                $result = 'Your Password is invalid ';
            }
        } else {
            $result = 'Your Login E-Mail invalid ';
        }
        unset($row);
        $conn = null;
        return $result;
    }
}

?>