<?php
// user/payment.php
include_once '../lib/PaymentProcessor.php';

// Check if the user is logged in
if (!UserAuth::isLoggedIn()) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle payment processing (e.g., integrate with a payment gateway)
    $amount = $_POST['amount'];
    $paymentProcessor = new PaymentProcessor();
    $paymentProcessor->processPayment($amount);

    // Update user account balance or campaign budget
}

include '../templates/header.php';
?>

<!-- Display payment processing form -->

<?php include '../templates/footer.php'; ?>
