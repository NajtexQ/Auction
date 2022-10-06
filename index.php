<?php
include_once "init.php";
include "loginProtect.php";

include "auctions/displayAuctions.php";

?>

<html>
<?php include "head.php"; ?>
<div>
    <a class="btn" href="auctions/createAuction.php">Create auction</a>
    <a class="btn" href="logout.php">Logout</a>
</div>

</html>