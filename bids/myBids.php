<?php

include_once "../init.php";
include "../loginProtect.php";

$query = "SELECT auctions.id, auctions.title, auctions.short_desc, auctions.category, auctions.owner_id, auctions.start_price, auctions.min_bid_increase, auctions.end_date, auctions.image, MAX(bids.amount) AS amount FROM auctions INNER JOIN bids ON auctions.id = bids.auction_id WHERE bids.user_id = $USER[id] GROUP BY auctions.id";
$result = mysqli_query($conn, $query);
$result2 = mysqli_query($conn, $query);

$wonAuctions = [];

if (mysqli_num_rows($result2) > 0) {

    $now = time();

    while ($row = mysqli_fetch_assoc($result2)) {

        $endDate = strtotime($row["end_date"]);
        $highestBid = getHighestBid($row["id"]);

        if ($endDate < $now && $highestBid["user_id"] == $USER["id"]) {
            array_push($wonAuctions, $row);
        } else {
            continue;
        }
    }
}

?>

<html>
<?php include "../head.php" ?>

<body>
    <?php include "../navbar.php" ?>

    <div class="content-container">
        <h1 class="page-title">My bids</h1>
        <div class="active-bids">
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <div class="display-auctions">
                    <div class="auctions-grid">
                        <?php

                        $now = time();

                        while ($row = mysqli_fetch_assoc($result)) {

                            $endDate = strtotime($row["end_date"]);

                            if ($endDate > $now) {
                                displayAuction($row);
                            } else {
                                continue;
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="no-bids">
                    <h2>You have no active bids</h2>
                </div>
            <?php endif; ?>
        </div>
        <?php if (count($wonAuctions) > 0) : ?>
            <h1 class="page-title">Won auctions</h1>
            <div class="won-auctions">
                <div class="display-auctions">
                    <div class="auctions-grid">
                        <?php
                        foreach ($wonAuctions as $auction) {
                            displayAuction($auction);
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>