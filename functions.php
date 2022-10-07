<?php

function displayAuction($props)
{
    global $USER;

    $currentBid = getHighestBid($props["id"]);
    $currentPrice = $currentBid["amount"] ?? $props["start_price"];
    $currentBidder = $currentBid["bidder"] ?? "None";

    $newBid = $currentPrice + $props["min_bid_increase"];

    echo "<div class='auction'>";
    echo "<h2>" . $props["title"] . "</h2>";
    echo "<p>" . $props["description"] . "</p>";
    echo "<p>Category: " . $props["category"] . "</p>";
    echo "<p>Current price: " . $currentPrice . "€" . "</p>";
    echo "<p>Highest bidder: " . $currentBidder . "</p>";
    echo "<p>Minimal bid increase: " . $props["min_bid_increase"] . "€" . "</p>";
    echo "<p>End date: " . $props["end_date"] . "</p>";
    echo "<a class='btn' href='" . rootUrl("/auctions/viewAuction.php?id=" . $props["id"]) . "'>View auction</a>";
    if ($props["owner_id"] == $USER["id"]) {
        echo "<a class='btn' href='" . rootUrl("/auctions/deleteAuction.php?id=" . $props["id"]) . "'>Delete auction</a>";
    } else {
        echo "<a class='btn' href='" . rootUrl("/bids/createBid.php?auctionId=" . $props["id"] . "&amount=" . $newBid) . "'>Bid (" . $newBid . "€" . ")</a>";
    }
    echo "</div>";
}

function getAuction($id)
{
    global $conn;
    $query = "SELECT * FROM auctions WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $auction = mysqli_fetch_assoc($result);
    return $auction;
}

function getCurrentPrice($auctionId)
{
    global $conn;
    $query = "SELECT * FROM bids WHERE auction_id = '$auctionId' ORDER BY amount DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    $bid = mysqli_fetch_assoc($result);
    if ($bid) {
        return $bid["amount"];
    } else {
        return getAuction($auctionId)["start_price"];
    }
}

function getHighestBid($auctionId)
{
    global $conn;
    $query = "SELECT b.*, u.username as bidder FROM bids b INNER JOIN users u ON b.user_id = u.id WHERE auction_id = '$auctionId' ORDER BY amount DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    $bid = mysqli_fetch_assoc($result);
    return $bid;
}
