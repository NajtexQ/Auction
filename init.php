<?php

include_once "config.php";
include_once "db.php";
include_once "functions.php";

session_start();

$USER = null;
if (isset($_SESSION["user_id"])) {
    $userQuery = "SELECT * FROM users WHERE id = ?";
    $result = runQuery($userQuery, "i", $_SESSION["user_id"]);
    $USER = $result->fetch_assoc();
}

$PAGE_TITLE = "Auction";
