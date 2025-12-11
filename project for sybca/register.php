<?php
require_once 'config.php';
require_once 'functions.php';

$username = $email = '';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    
    // Validate inputs
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } elseif ($password != $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        // Check if username or email already exists
        $sql = "SELECT id FROM users WHERE username = ? OR email = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $error = 'Username or email is already taken.';
                } else {
                    // Insert new user
                    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                    
                    if ($stmt = mysqli_prepare($link, $sql)) {
                        // Hash the password
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        
                        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);
                        
                        if (mysqli_stmt_execute($stmt)) {
                            $success = 'Registration successful. You can now <a href="index.html">login</a>.';
                            // Clear form
                            $username = $email = '';
                        } else {
                            $error = 'Something went wrong. Please try again later.';
                        }
                    }
                }
            } else {
                $error = 'Oops! Something went wrong. Please try again later.';
            }
            
            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="s.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php display_error($error); ?>
        <?php display_success($success); ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Register">
            </div>
        </form>
        
        <div class="text-center mt-3">
            <p>Already have an account? <a href="i.php">Login here</a>.</p>
        </div>
    </div>
</body>
</html>