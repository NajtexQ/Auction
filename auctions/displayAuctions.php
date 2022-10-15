<?php

$currentPage = $_GET['page'] ?? 1;
$auctionsPerPage = 6;

$countQuery = "SELECT COUNT(*) as auction_count FROM auctions WHERE end_date > NOW()";
$countResult = mysqli_query($conn, $countQuery);

$countResult = mysqli_fetch_assoc($countResult);

$numOfPages = ceil($countResult["auction_count"] / $auctionsPerPage);

$offset = ($currentPage - 1) * $auctionsPerPage;

$query = "SELECT * FROM auctions WHERE end_date > NOW() LIMIT $auctionsPerPage OFFSET $offset";

$result = mysqli_query($conn, $query);

?>

<div class="display-auctions">
    <div class="auctions-grid">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                displayAuction($row);
            }
        } else {
            echo "No auctions";
        }
        ?>
    </div>
</div>
<div class="page-buttons">
    <?php if ($currentPage > 1) : ?>
        <a href="<?php echo ("?page=" . $currentPage - 1) ?>" class="btn btn-secondary btn-big" id="previous-page">Previous page</a>
    <?php endif; ?>
    <?php if ($currentPage < $numOfPages) : ?>
        <a href="<?php echo ("?page=" . $currentPage + 1) ?>" class="btn btn-big" id="next-page">Next page</a>
    <?php endif; ?>
</div>