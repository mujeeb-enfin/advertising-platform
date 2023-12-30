<?php
// ad/create.php
include_once '../lib/AdManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imageUrl = $_POST['image_url'];
    $advertiserId = $_SESSION['user_id']; // Assuming you store user_id in the session

    $adManager = new AdManager();
    $adManager->createAd($title, $description, $imageUrl, $advertiserId);

    // Redirect to the user's dashboard or ad listing page
    header('Location: ../user/dashboard.php');
    exit();
}

include '../templates/header.php';
?>

<!-- Display ad creation form -->

<?php include '../templates/footer.php'; ?>
