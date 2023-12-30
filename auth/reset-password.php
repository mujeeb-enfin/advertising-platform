<?php
// auth/reset-password.php
include_once '../lib/UserAuth.php';

$userAuth = new UserAuth($db); // Assuming you have a database instance

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];

    // Validate the token and reset the user's password
    $result = $userAuth->resetPassword($token, $newPassword);

    if ($result === UserAuth::RESET_SUCCESS) {
        // Password reset successful, display a success message or redirect to the login page
        header('Location: login.php');
        exit();
    } elseif ($result === UserAuth::RESET_TOKEN_INVALID) {
        // Token is invalid or expired, display an error message
        $error = 'Invalid or expired reset token.';
    } else {
        // Something went wrong, display an error message
        $error = 'Password reset failed.';
    }
}

include '../templates/header.php';
?>

<!-- Display the password reset form -->

<?php include '../templates/footer.php'; ?>
