<?php
// campaign/edit.php
include_once '../lib/CampaignManager.php';

$campaignManager = new CampaignManager($db); // Assuming you have a database instance

// Check if the campaign ID is provided in the URL
if (isset($_GET['id'])) {
    $campaignId = $_GET['id'];

    // Load campaign details
    $campaignDetails = $campaignManager->getCampaignDetails($campaignId);

    if (!$campaignDetails) {
        // Campaign not found, display an error message or redirect
        $error = 'Campaign not found.';
    }
} else {
    // Campaign ID not provided, display an error message or redirect
    $error = 'Campaign ID not provided.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $campaignName = $_POST['campaign_name'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    // Additional validation and sanitization may be required

    // Update the campaign
    $result = $campaignManager->updateCampaign($campaignId, $campaignName, $startDate, $endDate);

    if ($result === CampaignManager::UPDATE_SUCCESS) {
        // Campaign update successful, display a success message or redirect
        header('Location: view.php?id=' . $campaignId);
        exit();
    } elseif ($result === CampaignManager::UPDATE_ERROR) {
        // Campaign update failed, display an error message
        $error = 'Failed to update the campaign.';
    }
}
else
{
    ?>
<h2>Edit Ad</h2>
<form action="ad/edit.php" method="post">
    <!-- Your form fields for ad editing -->
    <input type="text" name="ad_title" placeholder="Ad Title">
    <input type="text" name="ad_content" placeholder="Ad Content">
    <input type="submit" value="Save Changes">
</form>

    <?php
}

include '../templates/header.php';
?>

<!-- Display the campaign editing form -->

<?php include '../templates/footer.php'; ?>
