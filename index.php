<?php
include_once "init.php";
include_once "loginProtect.php";

include_once "auctions/checkForExpired.php";

?>

<html>
<?php include "head.php"; ?>
<div>
    <?php
    include "navbar.php";
    ?>
    <div class="content-container">
        <?php
        include "auctions/displayAuctions.php";
        ?>
    </div>
</div>

</html>