<?php
// user/feedback.php
include_once '../lib/FeedbackManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $feedback = $_POST['feedback'];

    // Save the user's feedback
    $feedbackManager = new FeedbackManager();
    $feedbackManager->saveFeedback($userId, $feedback);

    // Display a thank you message or redirect to the homepage
}

include '../templates/header.php';
?>

<!-- Display the feedback form -->

<?php include '../templates/footer.php'; ?>
