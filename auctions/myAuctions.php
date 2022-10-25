<?php

include_once "../init.php";
include_once "../loginProtect.php";

$userId = $USER["id"];

$query = "SELECT * FROM auctions WHERE owner_id = ? ORDER BY id DESC";

$result = runQuery($query, "i", $userId);

?>
<html>
<?php include "../head.php"; ?>

<body>
    <?php include "../navbar.php"; ?>
    <div class="content-container">
        <div class="page-title">
            <h1>My auctions</h1>
        </div>
        <div class="display-auctions">
            <?php
            if ($result->num_rows > 0) {
            ?>
                <div class="auctions-grid">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        displayAuction($row);
                    }
                } else {
                    ?>
                    <div class="no-auctuins"></div>
                <?php
                    echo "<p>You don't have any auctions!</p>";
                }
                ?>
                </div>
        </div>
    </div>
</body>

</html>