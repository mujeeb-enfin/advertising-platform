<?php
// auth/login.php
include_once '../lib/UserAuth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (UserAuth::login($username, $password)) {
        // Successful login, redirect to the dashboard
        header('Location: ../user/dashboard.php');
        exit();
    } else {
        // Failed login, display an error message
        $error = 'Invalid username or password';
    }
}

include '../templates/header.php';
?>

<!-- Display login form -->
<div class="container">
    <h2>Login</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
