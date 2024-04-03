<?php

// Assuming you have already established a database connection
include_once("db_connection.php");

// Check if the user ID is set in the session
if(isset($_SESSION["user_id"])) {
    // Get the current user's ID from session
    $user_id = $_SESSION["user_id"];

    // Query the database to get the user's information
    $sql = "SELECT firstname, lastname, role FROM users WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_name = $row["firstname"] . " " . $row["lastname"]; // Concatenate first name and last name
        $user_role = $row["role"];
    } else {
        // Handle the case where the query fails or no user is found
        // You might want to log an error or redirect to an error page
        $user_name = "Unknown";
        $user_role = "Unknown";
    }
} else {
    // Redirect to the sign-in page if user ID is not set in the session
    header("Location: signin.php");
    exit(); // Ensure script execution stops after redirection
}
?>
