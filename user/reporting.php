<?php
// user/reporting.php
include_once '../lib/ReportGenerator.php';

// Check if the user is logged in
if (!UserAuth::isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$reportGenerator = new ReportGenerator();
$reportData = $reportGenerator->generateReport($_SESSION['user_id']);

include '../templates/header.php';
?>

<!-- Display reporting dashboard with campaign performance data -->

<?php include '../templates/footer.php'; ?>
