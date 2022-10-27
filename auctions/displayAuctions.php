<?php

$currentPage = $_GET['page'] ?? 1;
$auctionsPerPage = 6;

$countQuery = "SELECT COUNT(*) as auction_count FROM auctions WHERE end_date > NOW()";
$countResult = runQuery($countQuery);
$count = $countResult->fetch_assoc();

$numOfPages = ceil($count["auction_count"] / $auctionsPerPage);

$offset = ($currentPage - 1) * $auctionsPerPage;

$query = "SELECT * FROM auctions WHERE end_date > NOW() LIMIT ? OFFSET ?";

$result = runQuery($query, "ii", $auctionsPerPage, $offset);

?>

<div class="auctions-page">
    <div class="display-auctions">
        <div class="auctions-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    displayAuction($row);
                }
            } else {
                echo "<div class='no-auctions'>No auctions found</div>";
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
</div>