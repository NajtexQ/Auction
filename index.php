<?php
include "init.php";
include "loginProtect.php";

echo "Logged in as:";
print_r($USER);

?>

<html>
<div>
    <a class="btn" href="auctions/createAuction.php">Create auction</a>
    <a class="btn" href="logout.php">Logout</a>
</div>

</html>