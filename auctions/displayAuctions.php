<?php

$query = "SELECT * FROM auctions;";

$result = mysqli_query($conn, $query);

?>

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