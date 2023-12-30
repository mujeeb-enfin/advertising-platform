<?php
// user/invoice.php
include_once '../lib/InvoiceGenerator.php';
include_once '../lib/AdManager.php';

// Retrieve user's ad campaign data
$userId = $_SESSION['user_id'];
$AdManager = new AdManager();
$adCampaignData = $AdManager->getAdCampaignData($userId);

// Generate an invoice for the user
$invoiceGenerator = new InvoiceGenerator();
$invoiceHtml = $invoiceGenerator->generateInvoice($userId, $adCampaignData);

include '../templates/header.php';
?>

<!-- Display the invoice HTML -->

<?php include '../templates/footer.php'; ?>
