<?php

include "../init.php";
include "../loginProtect.php";

$auctionId = $_GET["id"];

$query = "SELECT * FROM auctions WHERE id = '$auctionId'";

$result = mysqli_query($conn, $query);

?>

<html>
<?php include "../head.php"; ?>

<body>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            displayAuction($row);
        }
    } else {
        echo "This auction does not exist";
    }
    ?>