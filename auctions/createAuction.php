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

?>

<html>

<body>

    <form action="createAuction.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title">
        <input type="text" name="description" placeholder="Description">
        <input type="text" name="category" placeholder="Category">
        <input type="text" name="startingPrice" placeholder="Starting price">
        <input type="text" name="minBidIncrease" placeholder="Minimal increase">
        <input type="date" name="endDate" placeholder="End date">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" name="submit">
    </form>

</body>

</html>