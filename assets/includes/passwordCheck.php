<?php
/**
 * Created by PhpStorm.
 * User: Hillary
 * Date: 5/2/2017
 * Time: 11:03 AM
 */

//function to generate salt
function generateSalt() {
    $salt = '$2y$13$' . substr(md5(uniqid(rand(), true)), 0, 22);
    return $salt;
}


//function to hash user password
function generateHash($password, $salt)
{
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        return crypt($password, $salt);
    } else {
        echo "Blowfish not defined";
    }
}

function verifyPassword($password, $hashedPassword) {

    return ($password == $hashedPassword);
    //Will use below return statement on Arthurs hosting
    //return hash_equals($password, $hashedPassword);
}

function generateRandomPassword() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#$%';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 8; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;

}

?>