<?php
// public/index.php
include_once '../lib/UserAuth.php';

// Initialize variables
$error = '';

// Check if the user is trying to log in
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the login credentials
    $userAuth = new UserAuth();
    $loggedIn = $userAuth->login($username, $password);

    if ($loggedIn) {
        // Successful login, redirect to the dashboard
        header('Location: ../user/dashboard.php');
        exit();
    } else {
        // Failed login, display an error message
        $error = 'Invalid username or password';
    }
}

// Check if the user is already logged in
if (UserAuth::isLoggedIn()) {
    // User is logged in, redirect to the dashboard
    header('Location: ../user/dashboard.php');
    exit();
}

// If not logged in, display the login form
include '../templates/header.php';
?>

<!-- Display the login form -->
<div>
    <h2>Login</h2>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="index.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
