<?php
// Include database connection
include_once("db_connection.php");

// Start or resume a session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the sign-in page
    header("Location: /src/signin.php");
    exit(); // Ensure script execution stops after redirection
}

// Default time format (12-hour)
$time_format = "h:i A"; // Example: 12:00 PM

// Check if the time format is set in the URL
if (isset($_GET['time_format']) && $_GET['time_format'] === '24') {
    $time_format = "H:i"; // Example: 12:00
}

// Fetch user logs from the database
$sql = "SELECT user_logs.log_id, user_logs.user_id, user_logs.time_in, user_logs.time_out, users.firstname, users.lastname 
        FROM user_logs 
        INNER JOIN users ON user_logs.user_id = users.id";
$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Logs</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="http://<?= $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') ?>/public/styles/font-awesome/fontawesome.min.css">
    <link rel="stylesheet"
        href="http://<?= $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') ?>/public/styles/font-awesome/brands.min.css">
    <link rel="stylesheet"
        href="http://<?= $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') ?>/public/styles/font-awesome/solid.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img src="public/images/gjc_logo.png" alt="Brand Image"
                        style="height: 30px; width: auto; margin-top: -5px;">
                </a>
                <a class="navbar-brand" href="/">GJC</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                </ul>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                // Fetch and display user's name
                                $userName = ""; // Initialize the variable
                                $userId = $_SESSION['user_id'];

                                // Query to fetch user's name based on user_id
                                $sql = "SELECT firstname, lastname, username FROM users WHERE id = $userId";
                                $result = mysqli_query($conn, $sql);

                                // Check if the query was successful
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $userName = !empty($row['username']) ? $row['username'] : $row['firstname'] . " " . $row['lastname'];
                                }

                                echo $userName;
                            } else {
                                echo "Guest";
                            }
?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <?php if (isset($_SESSION['user_id'])): ?>
                            <li>
                                <form
                                    action="http://<?= $_SERVER['HTTP_HOST'] ?>/signout.php"
                                    method="post">
                                    <button type="submit" class="btn btn-link" style="margin-left: 10px;">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                            <?php else: ?>
                            <li>
                                <button class="btn btn-primary mr-2 mt-2"
                                    onclick="window.location.href='http://<?= $_SERVER['HTTP_HOST'] ?>/src/signin.php'">Login</button>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container mt-5">
        <div class="container-fluid">
            <div class="navbar-header">
                <h3 class="mb-4">User Logs</h3>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Time Format
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="?time_format=12">12 Hour</a></li>
                        <li><a href="?time_format=24">24 Hour</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="container mt-5">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result2) > 0): ?>
                        <?php while ($row2 = mysqli_fetch_assoc($result2)): ?>
                        <tr>
                            <td><?= $row2["log_id"] ?>
                            </td>
                            <td><?= $row2["firstname"] . " " . $row2["lastname"] ?>
                            </td>
                            <td><?= date($time_format, strtotime($row2["time_in"])) ?>
                            </td>
                            <td>
                                <?php
    if ($row2["time_out"] !== null) {
        echo date($time_format, strtotime($row2["time_out"]));
    } else {
        echo "No time out recorded";
    }
                            ?>
                            </td>

                        </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan='4'>No user logs found.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="container row">
                <button class="btn btn-primary btn-lg btn-block mb-5 p-5"
                    onclick="window.location.href = '../index.php';">Proceed to HomePage</button> &nbsp;
            </div>

            <div class="container row">
                <a href="log_time.php" class="btn btn-success btn-lg btn-block">
                    <i class="fas fa-history"></i> View Log Time
                </a>
            </div>
        </div>
    </div>
</body>

</html>