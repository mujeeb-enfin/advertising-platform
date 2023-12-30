<?php
// user/advertiser-dashboard.php
include_once '../lib/AdBudgetManager.php';
include_once '../lib/AdvertiserDashboard.php';

// ... other code ...

// Manage ad budgets
$adBudgetManager = new AdBudgetManager();
$advertiserDashboard = new AdvertiserDashboard();
$advertiserBudget = $adBudgetManager->getAdvertiserBudget($advertiserId);
$advertiserDashboard->uploadCustomAdCreative($advertiserId, $creativeData);

