<?php
// dashboard/PrivacyDashboard.php
include_once '../lib/UserAuth.php'; // Include your UserAuth class or authentication logic
include_once '../lib/Database.php'; // Include your Database class or connection logic

// Assuming you have a Database instance
$database = new Database();
$db = $database->getConnection();

// Check if the user is logged in (you may have a UserAuth class for this)
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login or display an error message
    header('Location: ../auth/login.php');
    exit();
}

$userAuth = new UserAuth($db);

// Assuming you have a User class with privacy-related methods
$user = $userAuth->getUserById($_SESSION['user_id']);

include '../templates/header.php';
?>

<!-- Display privacy dashboard content -->
<div>
    <h2>Privacy Dashboard</h2>

    <!-- Display user's privacy settings and data -->

    <h3>Privacy Settings</h3>
    <ul>
        <li>Email Notifications: <?php echo ($user['receive_notifications']) ? 'Enabled' : 'Disabled'; ?></li>
        <!-- Add more privacy settings based on your application -->
    </ul>

    <h3>Your Data</h3>
    <!-- Display and manage user data based on your application -->

    <p><a href="update-privacy-settings.php">Update Privacy Settings</a></p>
</div>

<?php include '../templates/footer.php'; ?>