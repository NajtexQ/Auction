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
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            displayAuction($row);
        }
    } else {
        echo "No auctions";
    }
    ?>
</body>

</html>