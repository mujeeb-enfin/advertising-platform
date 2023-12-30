<?php
// public/ad-serve.php
include_once '../lib/AdManager.php';

// Get targeting information from the request (e.g., device type, user details)
$deviceType = $_GET['device_type'] ?? 'desktop';
$userId = $_GET['user_id'] ?? null;

$adManager = new AdManager();
$ad = $adManager->serveAd($deviceType, $userId);

// Return ad information as JSON
header('Content-Type: application/json');

if ($ad) {
    echo json_encode($ad);
} else {
    // Handle the scenario where no ad is available for the specified targeting
    http_response_code(404);
    echo json_encode(['error' => 'No ad available for the specified targeting.']);
}

exit();
?>
