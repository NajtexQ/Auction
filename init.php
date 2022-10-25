<?php

include_once "db.php";
include_once "config.php";

session_start();

$USER = null;
if (isset($_SESSION["user_id"])) {
    $userQuery = "SELECT * FROM users WHERE id = '$_SESSION[user_id]'";
    $userResult = mysqli_query($conn, $userQuery);
    $USER = mysqli_fetch_assoc($userResult);
}

$PAGE_TITLE = "Auction";

include_once "functions.php";
