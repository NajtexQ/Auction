<!DOCTYPE html>
<?php
include_once "../init.php";
include_once "../loginProtect.php";

if (isset($_POST["submit"])) {

    include "../upload.php";

    $title = $_POST["title"];
    $short_desc = $_POST["short_desc"];
    $long_desc = $_POST["long_desc"];
    $startPrice = $_POST["startingPrice"];
    $minPrice = $_POST["minPrice"];
    $minBidIncrease = $_POST["minBidIncrease"];
    $category = $_POST["category"];
    $owner_id = $USER["id"];
    $image = $uniqueFileName;
    $endDate = $_POST["endDate"];

    if (empty($title) || empty($short_desc) || empty($long_desc) || empty($startPrice) || empty($minBidIncrease) || empty($category) || empty($endDate)) {
        displayError("Please fill in all fields");
    } else if ($startPrice < 0) {
        displayError("Starting price must be greater than 0");
    } else if ($minBidIncrease < 0) {
        displayError("Minimum bid increase must be greater than 0");
    } else if ($endDate < date("Y-m-d")) {
        displayError("End date must be in the future");
    } else {
        $query = "INSERT INTO auctions (title, short_desc, long_desc, category, owner_id, start_price, min_bid, min_bid_increase, end_date, image) VALUES (?, ? ,? ,? ,? ,? ,? ,? ,? ,?)";
        $result = runQuery($query, "sssssisiss", $title, $short_desc, $long_desc, $category, $owner_id, $startPrice, $minPrice, $minBidIncrease, $endDate, $image);

        if ($result) {
            header("Location: ../index.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

function getCategories()
{
    $query = "SELECT * FROM auction_categories";
    return runQuery($query);
}

?>

<html>

<?php include "../head.php"; ?>

<body>

    <?php include "../navbar.php";
    ?>

    <div class="auction-create-container">
        <div class="page-title">
            <h1>Create auction</h1>
        </div>
        <form class="auction-create-form" action="createAuction.php" method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title">
            <input type="text" name="short_desc" placeholder="Short description">
            <input type="text" name="long_desc" placeholder="Long description">
            <select name="category">
                <option value="unlisted" selected>Unlisted</option>
                <?php
                $categories = getCategories();

                foreach ($categories as $category) {
                    if ($category["name"] == 'unlisted') {
                        continue;
                    }
                    echo "<option value='" . $category["name"] . "'>" . $category["label"] . "</option>";
                }
                ?>
            </select>
            <input type="text" name="startingPrice" placeholder="Starting price">
            <input type="text" name="minPrice" placeholder="Minimum price">
            <input type="text" name="minBidIncrease" placeholder="Minimal increase">
            <input type="date" name="endDate" placeholder="End date">
            <div class="file-upload">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <input class="btn" type="submit" name="submit">
        </form>
    </div>

</body>

</html>