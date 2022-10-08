<?php

include_once "../init.php";
include "../loginProtect.php";

$query = "SELECT auctions.id, auctions.title, auctions.short_desc, auctions.category, auctions.owner_id, auctions.start_price, auctions.min_bid_increase, auctions.end_date, auctions.image, MAX(bids.amount) AS amount FROM auctions INNER JOIN bids ON auctions.id = bids.auction_id WHERE bids.user_id = $USER[id] GROUP BY auctions.id";
$result = mysqli_query($conn, $query);

?>

<html>
<?php include "../head.php" ?>

<body>
    <?php include "../navbar.php" ?>

    <div class="content-container">
        <h1 class="page-title">My bids</h1>
        <div class="display-auctions">
            <div class="auctions-grid">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        displayAuction($row);
                    }
                } else {
                    echo "No auctions";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>