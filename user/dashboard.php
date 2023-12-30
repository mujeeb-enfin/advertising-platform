<?php
// user/dashboard.php
include_once '../lib/AdAnalytics.php';
include_once '../lib/Database.php'; // Assuming you have a Database class
$database = new Database();
$db = $database->getConnection();


// Fetch ad performance data for the dashboard
$adAnalytics = new AdAnalytics($db);
$adPerformanceData = $adAnalytics->getAdPerformanceData($userId);

// ... rest of the dashboard code
