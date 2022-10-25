<?php

include_once "db.php";
include_once "config.php";

session_start();

$USER = null;
if (isset($_SESSION["user_id"])) {
    $userQuery = "SELECT * FROM users WHERE id = ?";
    $USER = runQuery($userQuery, "i", $_SESSION["user_id"]);
}

$PAGE_TITLE = "Auction";

include_once "functions.php";
