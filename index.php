<?php

// Start or resume a session
session_start();

// Check if the user is logged in
if(!isset($_SESSION['user_id'])) {
    // User is not logged in
    // Redirect to the sign-in page
    // Get host and URI
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $src = 'https://' . $host . $uri;

    $signin_path = $src . '/src/signin.php';
    header("Location: $signin_path");
    exit(); // Ensure script execution stops after redirection
}

// Include the index.html file
include 'index.html';
?>
