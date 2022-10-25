<?php

include_once "../init.php";
include_once "../loginProtect.php";

$auctionId = $_GET["id"];

$query = "SELECT * FROM auctions WHERE id = '$auctionId'";

$result = mysqli_query($conn, $query);

$auction = mysqli_fetch_assoc($result);

?>

<html>
<?php include "../head.php"; ?>

<body>
    <?php include "../navbar.php"; ?>
    <div class="content-container">
        <?php

        if (mysqli_num_rows($result) > 0) {

            echo "<h1 class='page-title'>$auction[title]</h1>";
            echo "<p class='page-subtitle'>$auction[short_desc]</p>";
            echo "<div class='view-auction-container'>";
            echo "<img src='" . rootUrl("/uploads/") . $auction["image"] . "' alt='auction image' class='view-auction-image'>";
            echo "<div class='view-auction-info'>";
            echo "<table class='view-auction-table'>";
            echo "<tr>";
            echo "<td>End Date:</td>";
            echo "<td>$auction[end_date]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Starting Price:</td>";
            echo "<td>$auction[start_price]€</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Current Price:</td>";
            echo "<td>$auction[start_price]€</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Category:</td>";
            echo "<td>$auction[category]</td>";
            echo "</tr>";
            echo "</table>";
            echo "</div>";
            if ($auction["owner_id"] != $USER["id"]) {
                echo "<form class='bid-form' action='" . rootUrl("/bids/createBid.php") . "' method='GET'>";
                echo "<input type='hidden' name='auctionId' value='$auctionId'>";
                echo "<input type='text' name='amount' placeholder='Enter your bid' class='view-auction-bid-input'>";
                echo "<input type='submit' value='Place Bid' class='btn'>";
                echo "</form>";
            }
            echo "</div>";
        } else {
            echo "<h1>Auction not found</h1>";
        }
        ?>
    </div>
</body>