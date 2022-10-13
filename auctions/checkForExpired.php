<?php

$query = "SELECT * FROM auctions WHERE end_date < NOW() AND owner_id = $USER[id]";
$result = mysqli_query($conn, $query);

foreach ($result as $auction) {
    $highestBid = getHighestBid($auction["id"]);
    if ($highestBid["amount"] < $auction["min_bid"]) {
        $delQuery = "DELETE FROM auctions WHERE id = $auction[id]";
        mysqli_query($conn, $delQuery);
    }
}
