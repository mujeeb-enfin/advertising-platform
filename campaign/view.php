<?php
// campaign/view.php
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

include '../templates/header.php';
?>

<!-- Display the campaign details -->
<div>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php else : ?>
        <h2><?php echo htmlspecialchars($campaignDetails['name']); ?></h2>
        <p>Start Date: <?php echo htmlspecialchars($campaignDetails['start_date']); ?></p>
        <p>End Date: <?php echo htmlspecialchars($campaignDetails['end_date']); ?></p>
        <p>Budget: $<?php echo number_format($campaignDetails['budget'], 2); ?></p>

        <!-- Add more details as needed -->

        <!-- Add edit and delete buttons (consider security) -->
        <a href="edit.php?id=<?php echo $campaignId; ?>">Edit Campaign</a>
        <form method="post" action="delete.php">
            <input type="hidden" name="id" value="<?php echo $campaignId; ?>">
            <button type="submit">Delete Campaign</button>
        </form>
    <?php endif; ?>
</div>

<?php include '../templates/footer.php'; ?>
