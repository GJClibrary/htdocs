<?php
// Database credentials
$servername = "localhost"; // Replace with your MySQL server hostname if different
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "gjc_library"; // Replace with the name of your MySQL database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
