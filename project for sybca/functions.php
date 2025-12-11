<?php
// Start the session
function start_session() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

// Check if user is logged in
function is_logged_in() {
    start_session();
    return isset($_SESSION['user_id']);
}

// Redirect to a different page
function redirect($url) {
    header("Location: $url");
    exit();
}

// Display error messages
function display_error($error) {
    if (!empty($error)) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
}

// Display success messages
function display_success($message) {
    if (!empty($message)) {
        echo '<div class="alert alert-success">' . $message . '</div>';
    }
}
?>