<?php

if ($USER == null) {
    header("Location: " . rootUrl("/login.php"));
}
