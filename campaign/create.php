<?php
// campaign/create.php
include_once '../lib/CampaignManager.php';

$campaignManager = new CampaignManager($db); // Assuming you have a database instance

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $campaignName = $_POST['campaign_name'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $budget = $_POST['budget']; // Assuming you have a 'budget' field in your form
    $advertiserId = $_POST['advertiser_id']; // Assuming you have an 'advertiser_id' field in your form

    // Additional validation and sanitization may be required

    // Create a new campaign
    $result = $campaignManager->createCampaign($campaignName, $startDate, $endDate, $budget, $advertiserId);

    if ($result === CampaignManager::CREATE_SUCCESS) {
        // Campaign creation successful, display a success message or redirect
        header('Location: view.php?id=' . $result['campaignId']);
        exit();
    } elseif ($result['status'] === CampaignManager::CREATE_ERROR) {
        // Campaign creation failed, display an error message
        $error = 'Failed to create a new campaign.';
    }
}
else
{
    ?>
    <h2>Create New Ad</h2>
<form action="ad/create.php" method="post">
    <!-- Your form fields for ad creation -->
    <input type="text" name="ad_title" placeholder="Ad Title">
    <input type="text" name="ad_content" placeholder="Ad Content">
    <input type="submit" value="Create Ad">
</form>

    <?php
}

include '../templates/header.php';
?>

<!-- Display the campaign creation form -->

<?php include '../templates/footer.php'; ?>
