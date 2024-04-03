<?php

// Start or resume a session
session_start();

// Get host and URI
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$src =  $host . $uri . '/add_book_success.php';


// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in
    // Redirect to the sign-in page
    header("Location: signin.php");
    exit(); // Ensure script execution stops after redirection
}

// Assuming you have already established a database connection
include_once("db_connection.php");

// Get the current user's ID from session
$user_id = $_SESSION["user_id"];

// Query the database to check if the user is a student
$sql = "SELECT role FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $role = $row["role"];

    if ($role === "student") {
        header("Location: not_allowed.php");
        exit();
    }
} else {
    // Handle the case where the query fails or no user is found
    // You might want to log an error or redirect to an error page
}

// Define variables for pagination
$limit = 10; // Number of books per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch books with pagination and associated data from the database
$sql = "SELECT b.*, u.firstname AS creator_firstname, u.lastname AS creator_lastname, GROUP_CONCAT(t.TagName SEPARATOR ', ') AS Tags
        FROM Books b
        LEFT JOIN BookTags bt ON b.BookID = bt.BookID
        LEFT JOIN Tags t ON bt.TagID = t.TagID
        LEFT JOIN users u ON b.user_id = u.id
        GROUP BY b.BookID
        LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<?php include("components/head.php"); ?>

<body>
    <!-- Navbar-->

    <?php include("components/nav.php"); ?>
    <div class="container">
        <!-- pagination -->

<nav aria-label="..." class="mt-2 mb-2 bg-light px-3">
    <div class="d-flex justify-content-between w-100">
            <div class="d-flex align-items-center">
            <a href="add_book.php" class="btn btn-primary">Add Another Book</a>
            </div>

            <div class="d-flex align-items-center mt-3">
              <ul class="pagination">
            <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="<?php echo '?page=' . ($page - 1); ?>">Previous</a>
            </li>
            <?php
            $sql_count = "SELECT COUNT(*) AS total FROM Books";
            $result_count = $conn->query($sql_count);
            $row_count = $result_count->fetch_assoc();
            $total_pages = ceil($row_count['total'] / $limit);
            for ($i = 1; $i <= $total_pages; $i++) {
                echo '<li class="page-item ' . (($page == $i) ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            }
            ?>
            <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                <a class="page-link" href="<?php echo '?page=' . ($page + 1); ?>">Next</a>
            </li>
        </ul>
            </div>

    </div>

    <div class="collapse sidebar-collapse" id="basic-navbar-nav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link text-dark" href="<?php echo "http://$host$uri/src/signin.php"; ?>">Signin</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="<?php echo "http://$host$uri/src/register.php"; ?>">Register</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="<?php echo "http://$host$uri/src/team.php"; ?>">Team</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="<?php echo "http://$host$uri/src/home.php"; ?>">Home</a></li>
        </ul>
    </div>
</nav>


        <?php
        // Check if the delete status session variable is set
        if (isset($_SESSION['delete_status'])) {
            if ($_SESSION['delete_status'] == 'success') {
                echo '<div class="alert alert-success" role="alert">Book deleted successfully!</div>';
            } elseif ($_SESSION['delete_status'] == 'error') {
                echo '<div class="alert alert-danger" role="alert">An error occurred while deleting the book.</div>';
            }
            // Unset the session variable to remove the message on page refresh
            unset($_SESSION['delete_status']);
        }
        ?>
        <h2 class="font-weight-bold mb-2">All Books <span class="badge badge-info"><?php echo $row_count['total']; ?></span></h2>



        <div class="row pb-5 mb-4">
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                        <div class="card rounded shadow-sm border-0">
                            <div class="card-body p-4">
                                <?php if (!empty($row['image'])) : ?>
                                    <img src="uploads/<?php echo $row['image']; ?>" alt="" class="img-fluid d-block mx-auto mb-3">
                                <?php else : ?>
                                    <p>No image available</p>
                                <?php endif; ?>
                                <h5><a href="#" class="text-dark"><?php echo $row['name']; ?></a></h5>
                                <p class="small text-muted font-italic">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <p><em>Quantity:</em> <?php echo $row['quantity']; ?></p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                                    <li class="list-inline-item m-0"><i class="fa fa-star-o text-success"></i></li>
                                </ul>

                                <button id="termsLink" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal_<?php echo $row['BookID']; ?>">Delete</button>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal_<?php echo $row['BookID']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Delete Book</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete <span class="font-weight-bold text-primary"><?php echo $row['name']; ?></span> book?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <a href="delete_book.php?id=<?php echo $row['BookID']; ?>" class="btn btn-danger">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No books found.</p>
            <?php endif; ?>
        </div>

        <!-- pagination -->
        <div class="mb-2 d-flex flex-row-reverse">
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?php echo '?page=' . ($page - 1); ?>">Previous</a>
                    </li>
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo '<li class="page-item ' . (($page == $i) ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    }
                    ?>
                    <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?php echo  '?page=' . ($page + 1); ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <?php include("components/scripts.php"); ?>
    </div>
    <?php include("components/main-end.php"); ?>
