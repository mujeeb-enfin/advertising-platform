<?php
// public/ad-impression.php
include_once '../lib/AdManager.php';

$adId = $_GET['ad_id'] ?? null;
$userId = $_GET['user_id'] ?? null;

$adManager = new AdManager();
$adManager->trackAdImpression($adId, $userId);

// Simulate the content of an empty image (transparent pixel)
$transparentPixel = base64_decode(
    'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAOXRFWHRTb2Z0d2FyZQBNYXR' .
    'oZHpvcml6b25lLm9yZ4zJopUUAAABBSURBVAhX3BAQEAAAABIP6PzgpLGlAAAAABJRU5ErkJggg=='
);

// Return a transparent pixel or an empty image
header('Content-Type: image/png');
echo $transparentPixel;
exit();
?>
