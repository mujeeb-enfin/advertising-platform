<?php
// auth/register.php
include_once '../lib/UserAuth.php';
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$userAuth = new UserAuth($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Form validation
    $errors = [];

    if (empty($username) || empty($password) || empty($confirmPassword) || empty($email)) {
        $errors[] = 'All fields are required';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }

    if ($password !== $confirmPassword) {
        $errors[] = 'Password and confirm password do not match';
    }

    // Password strength validation
    $minPasswordLength = 8;
    if (strlen($password) < $minPasswordLength) {
        $errors[] = 'Password should be at least ' . $minPasswordLength . ' characters long';
    }

    // Check for duplicate username or email
    if ($userAuth->isUsernameTaken($username)) {
        $errors[] = 'Username is already taken';
    }

    if ($userAuth->isEmailTaken($email)) {
        $errors[] = 'Email is already registered';
    }

    if (empty($errors)) {
        // Registration logic
        if ($userAuth->register($username, $password, $email)) {
            // Successful registration, redirect to the login page
            header('Location: login.php');
            exit();
        } else {
            // Failed registration, display an error message
            $errors[] = 'Registration failed';
        }
    }
}

include '../templates/header.php';
?>

<!-- Display registration form -->

<?php
if (!empty($errors)) {
    echo '<div class="error-message">';
    foreach ($errors as $error) {
        echo '<p>' . $error . '</p>';
    }
    echo '</div>';
}
?>

<!-- Display registration form HTML -->

<?php include '../templates/footer.php'; ?>
