<?php
// community-forum/index.php
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

// Load categories, recent posts, or other relevant forum data
// Example SQL queries (adjust based on your database schema)
// $categories = $db->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
// $recentPosts = $db->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

include '../templates/header.php';
?>

<!-- Display forum content -->
<div>
    <h2>Welcome to the Community Forum!</h2>

    <!-- Display categories, recent posts, or other forum content -->

    <p><a href="create-post.php">Create a new post</a></p>
</div>

<?php include '../templates/footer.php'; ?>
