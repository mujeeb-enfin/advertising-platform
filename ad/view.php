<?php
// ad/view.php
include_once '../lib/AdManager.php';

$adId = $_GET['ad_id']; // Get ad_id from the URL

$adManager = new AdManager();
$ad = $adManager->viewAd($adId);

include '../templates/header.php';
?>

<!-- Display ad details -->

<?php include '../templates/footer.php'; ?>
