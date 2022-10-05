<?php

$query = "SELECT * FROM auctions;";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='auction'>";
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<p>" . $row["description"] . "</p>";
        echo "<p>Category: " . $row["category"] . "</p>";
        echo "<p>Start price: " . $row["start_price"] . "</p>";
        echo "<p>Minimal bid increase: " . $row["min_bid_increase"] . "</p>";
        echo "<p>End date: " . $row["end_date"] . "</p>";
        echo "<img src='../uploads/" . $row["image"] . "' alt=''>";
        echo "</div>";
    }
} else {
    echo "No auctions";
}
