<?php
require_once 'functions.php';

start_session();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
redirect('index.php');
?>