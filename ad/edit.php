<?php
// ad/edit.php
include_once '../lib/AdManager.php';

$adId = $_GET['ad_id']; // Get ad_id from the URL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imageUrl = $_POST['image_url'];

    $adManager = new AdManager();
    $adManager->editAd($adId, $title, $description, $imageUrl);

    // Redirect to the ad viewing page
    header("Location: view.php?ad_id={$adId}");
    exit();
}

include '../templates/header.php';
?>

<!-- Display ad editing form -->

<?php include '../templates/footer.php'; ?>
