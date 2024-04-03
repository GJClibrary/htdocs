<?php

// Start or resume a session
session_start();

// Get host and URI
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$src = '/src';


// Check if the user is logged in
if(!isset($_SESSION['user_id'])) {
    // User is not logged in
    // Redirect to the sign-in page
    header("Location: signin.php");
    exit(); // Ensure script execution stops after redirection
}

// Assuming you have already established a database connection
include_once("db_connection.php");

// Initialize variables to store book details
$book_name = '';
$book_image = '';

// Check if the book ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $book_id = $_GET['id'];

    // Fetch the book details before deleting it
    $fetch_book_sql = "SELECT name, image FROM Books WHERE BookID = $book_id";
    $result = $conn->query($fetch_book_sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $book_name = $row['name'];
        $book_image = $row['image'];
    }

    // First, delete associated records in the BookTags table
    $delete_tags_sql = "DELETE FROM BookTags WHERE BookID = $book_id";
    if ($conn->query($delete_tags_sql) === TRUE) {
        // Associated tags deleted successfully, proceed to delete the book
        $delete_book_sql = "DELETE FROM Books WHERE BookID = $book_id";
        if ($conn->query($delete_book_sql) === TRUE) {
            // Book deleted successfully
            echo '<script>
                    $(document).ready(function() {
                        $("#deleteModal_' . $book_id . '").modal("show");
                    });
                </script>';
        } else {
            // Error occurred while deleting the book
            echo "Error: " . $delete_book_sql . "<br>" . $conn->error;
        }
    } else {
        // Error occurred while deleting associated tags
        echo "Error: " . $delete_tags_sql . "<br>" . $conn->error;
    }
} else {
    // Redirect to add_book_success.php if book ID is not provided
    header("Location: add_book_success.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Deletion Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 40px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 20px;
        }
        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Deletion Successful</h2>
        <?php if(!empty($book_name)): ?>
            <img src="<?php echo 'uploads/' . $book_image; ?>" alt="Book Image">
            <p>Book <span style="font-weight: bold; color: #007bff;">"<?php echo $book_name; ?>" </span>has been successfully deleted!</p>
        <?php else: ?>
            <p>Book has been successfully deleted!</p>
        <?php endif; ?>
        <a href="<?php echo "http://$host/src/add_book_success.php"; ?>" class="btn">Go Back</a>
    </div>
</body>
</html>
