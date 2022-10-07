<?php
include_once "init.php";
include "loginProtect.php";

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