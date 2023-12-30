<?php
// auth/forgot-password.php
include_once '../lib/UserAuth.php';
include_once '../lib/EmailNotifier.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Validate the email and send a password reset email
    if (UserAuth::sendPasswordResetEmail($email)) {
        // Display a success message or redirect to a confirmation page
        $successMessage = "Password reset email sent successfully. Check your email for further instructions.";
    } else {
        // Display an error message
        $errorMessage = "Error sending password reset email. Please try again.";
    }
}

include '../templates/header.php';
?>

<!-- Display the password reset request form -->
<div class="container">
    <h2>Forgot Password</h2>

    <?php if (isset($successMessage)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Send Password Reset Email</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
