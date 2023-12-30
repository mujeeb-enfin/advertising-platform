<?php
// public/ad-click.php
include_once '../lib/AdManager.php';

// Sanitize input parameters to prevent SQL injection and other security issues
$adId = filter_input(INPUT_GET, 'ad_id', FILTER_VALIDATE_INT);
$userId = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);

if (!$adId || !$userId) {
    // Invalid or missing parameters, handle accordingly (e.g., log, redirect, display error)
    // For simplicity, we'll redirect to the home page in case of an issue
    header('Location: /');
    exit();
}

$adManager = new AdManager();

// Validate if the user has permission to view/click the ad
if (!$adManager->isUserAuthorized($adId, $userId)) {
    // Unauthorized access, handle accordingly (e.g., log, redirect, display error)
    // For simplicity, we'll redirect to the home page in case of unauthorized access
    header('Location: /');
    exit();
}

// Track the ad click
$adManager->trackAdClick($adId, $userId);

// Get the destination URL for the ad
$destinationUrl = $adManager->getAdDestinationUrl($adId);

if (!$destinationUrl) {
    // Handle scenarios where the destination URL is not available (e.g., log, redirect, display error)
    // For simplicity, we'll redirect to the home page in case of an issue
    header('Location: /');
    exit();
}

// Redirect to the actual ad destination URL
header('Location: ' . $destinationUrl);
exit();
?>
