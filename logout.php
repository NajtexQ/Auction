<?php
include_once "init.php";

session_destroy();

header("Location: login.php");
