<?php
// Start session to manage user login state
session_start();

// Check if the user is not logged in, redirect to signin.php
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: signin.php");
    exit();
}

// Include database connection
include_once("db_connection.php");

// Get the current user's ID from session
$user_id = $_SESSION["user_id"];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check file type and size (you can modify these as needed)
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $max_size = 5 * 1024 * 1024; // 5 MB

    $file_name = $_FILES["image"]["name"];
    $file_size = $_FILES["image"]["size"];
    $file_tmp = $_FILES["image"]["tmp_name"];
    $file_type = $_FILES["image"]["type"];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!in_array($file_ext, $allowed_types)) {
        echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
    } elseif ($file_size > $max_size) {
        echo "Error: File size exceeds the limit (5MB).";
    } else {
        // Move the uploaded file to desired directory
        $upload_dir = "uploads/";
        $upload_path = $upload_dir . $file_name;

        if (move_uploaded_file($file_tmp, $upload_path)) {
            echo "File uploaded successfully.";

            // Get other book information from the form
            $name = $_POST['name'];
            $author = $_POST['author']; // Added author field
            $tags = $_POST['tags']; // Tags are now an array
            $quantity = $_POST['quantity']; // Added quantity field

            // Insert book into Books table including the user's ID, author, and quantity
            $sql = "INSERT INTO Books (name, user_id, author, quantity, image) VALUES ('$name', '$user_id', '$author', '$quantity', '$file_name')";

            // Execute SQL query to insert book
            if ($conn->query($sql) === true) {
                // Get the ID of the newly inserted book
                $bookID = $conn->insert_id;

                // Array to store new tag IDs
                $newTagIDs = array();

                // Check if each tag exists, and insert if not
                foreach ($tags as $tag) {
                    $tagName = $conn->real_escape_string(trim($tag)); // Sanitize input

                    // Check if tag already exists
                    $checkTagSql = "SELECT TagID FROM Tags WHERE TagName = '$tagName'";
                    $result = $conn->query($checkTagSql);

                    if ($result && $result->num_rows > 0) {
                        // Tag exists, get its ID
                        $row = $result->fetch_assoc();
                        $tagID = $row['TagID'];
                    } else {
                        // Tag doesn't exist, insert it
                        $insertTagSql = "INSERT INTO Tags (TagName) VALUES ('$tagName')";
                        if ($conn->query($insertTagSql) === true) {
                            // Get the ID of the newly inserted tag
                            $tagID = $conn->insert_id;
                            // Store new tag ID
                            $newTagIDs[] = $tagID;
                        } else {
                            echo "Error: " . $insertTagSql . "<br>" . $conn->error;
                        }
                    }

                    // Insert book-tag association into BookTags table
                    $insertBookTagSql = "INSERT INTO BookTags (BookID, TagID) VALUES ('$bookID', '$tagID')";
                    $conn->query($insertBookTagSql);
                }

                // Handle new tag IDs
                foreach ($newTagIDs as $newTagID) {
                    // Insert book-tag association for new tags
                    $insertBookTagSql = "INSERT INTO BookTags (BookID, TagID) VALUES ('$bookID', '$newTagID')";
                    $conn->query($insertBookTagSql);
                }

                // Redirect to a success page or display a success message
                header("Location: add_book_success.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading file.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/themes/github.css">
    <link rel="stylesheet" href="assets/app.css">
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-42755476-1', 'bootstrap-tagsinput.github.io');
        ga('send', 'pageview');
    </script>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Upload Image
                    </div>
                    <div class="card-body">
                        <form action="upload_image.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="image">Choose Image:</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Author:</label>
                                <input type="text" class="form-control" id="author" name="author" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags:</label>
                                <div class="bs-example">
                                    <select multiple data-role="tagsinput" name="tags[]">
                                        <?php
                // Fetch all existing tags from the database
                $tagsQuery = "SELECT * FROM Tags";
$tagsResult = $conn->query($tagsQuery);

// Display existing tags as options in the dropdown menu
if ($tagsResult->num_rows > 0) {
    while ($row = $tagsResult->fetch_assoc()) {
        echo "<option value='" . $row['TagName'] . "'>" . $row['TagName'] . "</option>";
    }
}
?>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>
    <script src="../dist/bootstrap-tagsinput.min.js"></script>
    <script src="../dist/bootstrap-tagsinput-angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/generic.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/html.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/javascript.js"></script>
    <script src="assets/app.js"></script>
    <script src="assets/app_bs3.js"></script>
</body>

</html>