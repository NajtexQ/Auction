<?php

include_once "../init.php";
include "../loginProtect.php";

$userId = $USER["id"];

$query = "SELECT * FROM auctions WHERE owner_id = '$userId' ORDER BY id DESC";

$result = mysqli_query($conn, $query);

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
            if (mysqli_num_rows($result) > 0) {
            ?>
                <div class="auctions-grid">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
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