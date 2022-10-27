<?php

$CONFIG = [
    "db" => [
        "host" => "localhost",
        "username" => "root",
        "password" => "",
        "database" => "auction"
    ],
    "paths" => [
        "root" => __DIR__,
    ],
    "urls" => [
        "root" => "http://localhost/auction"
    ]
];

function rootUrl($path = "")
{
    global $CONFIG;
    return $CONFIG["urls"]["root"] . $path;
}
