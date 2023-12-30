<?php
// user/settings.php
include_once '../lib/UserAuth.php';

// Check if the user is logged in
if (!UserAuth::isLoggedIn()) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle user settings update (change password, etc.)
}

include '../templates/header.php';
?>

<!-- Display user account settings form -->

<?php include '../templates/footer.php'; ?>
