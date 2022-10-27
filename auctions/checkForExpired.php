<?php

$query = "SELECT * FROM auctions WHERE end_date < NOW() AND owner_id = ?";
$result = runQuery($query, "i", $USER["id"]);
$expiredAuctions = $result->fetch_all(MYSQLI_ASSOC);

foreach ($expiredAuctions as $auction) {
    $highestBid = getHighestBid($auction["id"]);
    if ($highestBid["amount"] < $auction["min_bid"]) {
        $delQuery = "DELETE FROM auctions WHERE id = ?";
        runQuery($delQuery, "i", $auction["id"]);
    }
}
