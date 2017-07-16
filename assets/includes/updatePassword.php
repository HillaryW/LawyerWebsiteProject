<?php
session_start();
require_once '/home/attorneyatlaw/dbcon.php';
require_once 'passwordCheck.php';

if (isset($_POST['submit'])) {
    if ((!empty($_POST['password']) && !empty($_POST['confirm'])) && ($_POST['password'] == $_POST['confirm'])) {
        $dbcon = new DbConn();
        $conn = $dbcon->getConnection();

        if (isset($_SESSION['admin'])){
            $user = $_SESSION['admin'];
        } else if (isset($_SESSION['user'])){
            $user = $_SESSION['user'];
        } else {
            echo "An error with the session";
        }
        $salt = generateSalt();
        $hash = generateHash($_POST['password'],$salt);

        $sql = "UPDATE users SET passcode = :password, salt = :salt, temp = 0 WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $user, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hash, PDO::PARAM_STR);
        $stmt->bindValue(':salt', $salt, PDO::PARAM_STR);
        $stmt->execute();
        echo 'reset';
    } else {
        echo "Passwords must match";
    }
} else {
    unset($row);
    $conn = null;
    echo "An error occurred please try again later,";
}
?>