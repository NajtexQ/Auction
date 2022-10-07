<?php

include_once "../init.php";
include "../loginProtect.php";


$userId = $USER["id"];
$amount = $_GET["amount"];
$auctionId = $_GET["auctionId"];
$currentPrice = getCurrentPrice($auctionId);
$auction = getAuction($auctionId);
$minBidIncrease = $auction["min_bid_increase"];
$endDate = $auction["end_date"];

if ($endDate < date("Y-m-d H:i:s")) {
    echo "Auction has ended";
    die();
}

if ($amount >= $currentPrice + $minBidIncrease) {
    $query = "INSERT INTO bids (user_id, auction_id, amount) VALUES ('$userId', '$auctionId', '$amount')";
    $result = mysqli_query($conn, $query);
}

if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
    header("Location: $previous");
} else {
    header("Location: rootUrl('/auctions/viewAuction.php?id=$auctionId')");
}
