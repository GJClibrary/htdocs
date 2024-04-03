
<?php
// Get host and URI
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];

$src =  $host;
$home_url = "$protocol://$host/index.php";
$signin_url = "$protocol://$host/back/sys/signin.php";
$registration_url = "$protocol://$host/back/sys/register.php";

?>