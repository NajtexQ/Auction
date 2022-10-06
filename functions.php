<?php

function displayAuction($props)
{
    global $USER;
    echo "<div class='auction'>";
    echo "<h2>" . $props["title"] . "</h2>";
    echo "<p>" . $props["description"] . "</p>";
    echo "<p>Category: " . $props["category"] . "</p>";
    echo "<p>Start price: " . $props["start_price"] . "</p>";
    echo "<p>Minimal bid increase: " . $props["min_bid_increase"] . "</p>";
    echo "<p>End date: " . $props["end_date"] . "</p>";
    echo "<a class='btn' href='" . rootUrl("/auctions/viewAuction.php?id=" . $props["id"]) . "'>View auction</a>";
    if ($props["owner_id"] == $USER["id"]) {
        echo "<a class='btn' href='deleteAuction.php?id=" . $props["id"] . "'>Delete auction</a>";
    }
    echo "</div>";
}
