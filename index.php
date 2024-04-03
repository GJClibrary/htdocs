<?php
/*****************************
docs.paxagency.com/php V 1.8.0 
mit license • by paxagency
*****************************/
define('APP_NAME', 'Project');
define('APP_VERSION', '0.0.1');
define('APP_LICENSE', 'MIT');
define('APP_AUTHOR', 'John Smith');

$_DIR = getcwd()."/";
require_once($_DIR.'back/sys/init.php'); 

// Start or resume a session
session_start();

// Check if the user is logged in
if(!isset($_SESSION['user_id'])) {
    // User is not logged in
    // Redirect to the sign-in page
    // Get host and URI
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];

    // Construct the sign-in path
    $signin_path = $protocol . '://' . $host . '/back/sys/signin.php';
    
    // Redirect to the sign-in page
    header("Location: $signin_path");
    exit(); // Ensure script execution stops after redirection
}

?>
