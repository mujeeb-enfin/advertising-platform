<?php
// auth/logout.php
include_once '../lib/UserAuth.php';

UserAuth::logout();

// Redirect to the home page or login page
header('Location: ../public/index.php');
exit();
?>
