<?php

include_once "../init.php";

$auctionId = $_GET["id"];

$query = "DELETE FROM auctions WHERE (id = '$auctionId') and (owner_id = '$USER[id]')";

$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: myAuctions.php");
} else {
    echo "Error deleting auction";
}
