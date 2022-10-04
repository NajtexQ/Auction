<?php
include "init.php";
include "loginProtect.php";

echo "Logged in as:";
print_r($USER);

?>

<html>
<div>
    <button>
        <a href="logout.php">Logout</a>
    </button>
</div>

</html>