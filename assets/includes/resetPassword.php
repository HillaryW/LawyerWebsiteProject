<?php
include_once 'swiftMailer.php';
include_once 'passwordCheck.php';
require_once '/home/attorneyatlaw/dbcon.php';


if (isset($_POST['submit'])) {
    if (!empty($_POST['username'])) {

        $dbcon = new DbConn();
        $conn = $dbcon->getConnection();

        $sql = "SELECT username, firstname, lastname FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch();

        if ($row) {
            $randomPw = generateRandomPassword();
            $salt = generateSalt();
            $hash = generateHash($randomPw,$salt);

            $sql = "UPDATE users SET passcode = :password, salt = :salt, temp = 1 WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
            $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
            $stmt->bindValue(':salt', $salt, PDO::PARAM_STR);
            $stmt->execute();

            sendNewPassword($row['username'],$row['firstname'] . " " . $row['lastname'],$randomPw);
            echo 'reset';
        } else {
            echo "Username does not exist";
        }
    } else {
        echo "Please enter a username";
    }
} else {
    unset($row);
    $conn = null;
    echo "An error occurred please try again";
}



?>