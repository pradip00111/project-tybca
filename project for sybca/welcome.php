<?php
require_once 'functions.php';

// Check if user is logged in, if not then redirect to login page
if (!is_logged_in()) {
    redirect('index.php');
}

// Get user information from session
start_session();
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>You have successfully logged in.</p>
        <div class="text-center mt-3">
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </div>
</body>
</html>