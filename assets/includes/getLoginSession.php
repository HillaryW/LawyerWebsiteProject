<?php
/*
 *  Team Red Hot Chili Jellos
 *  Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
 *  File: getLoginSession.php
 *  Purpose: This file verifies if the user is logged in.
 */

//verify user is logged in
  session_start();
  $currentSession = isset($_SESSION['login_user']) ? true : false;
  echo json_encode($currentSession);
 ?>