<?php

include_once "../init.php";

$auctionId = $_GET["id"];

$query = "DELETE FROM auctions WHERE (id = ?) and (owner_id = ?)";

$result = runQuery($query, "ii", $auctionId, $USER["id"]);

if ($result) {
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
        header("Location: $previous");
    } else {
        header("Location: myAuctions.php");
    }
} else {
    echo "Error deleting auction";
}
