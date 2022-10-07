<!DOCTYPE html>
<?php
include_once "../init.php";
include "../loginProtect.php";

if (isset($_POST["submit"])) {

    include "../upload.php";

    $title = $_POST["title"];
    $description = $_POST["description"];
    $startPrice = $_POST["startingPrice"];
    $minBidIncrease = $_POST["minBidIncrease"];
    $category = $_POST["category"];
    $owner_id = $USER["id"];
    $image = $uniqueFileName;
    $endDate = $_POST["endDate"];

    $query = "INSERT INTO auctions (title, description, category, owner_id, start_price, min_bid_increase, end_date, image) VALUES ('$title', '$description', '$category', '$owner_id', '$startPrice', '$minBidIncrease', '$endDate', '$image')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: ../index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

function getCategories()
{
    global $conn;
    $query = "SELECT * FROM auction_categories";
    $result = mysqli_query($conn, $query);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $categories;
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
            <input type="text" name="description" placeholder="Description">
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