<?php
/*
 *  Team Red Hot Chili Jellos
 *  Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
 *  File: destroySession.php
 *  Purpose: This file logs out the user by destroying the session
 *  created from the login.
 */

//destroy session when user logs out
    session_start();
    unset($_SESSION['login_user']);
    session_destroy();
?>