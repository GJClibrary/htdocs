<?php
// Set the timezone to Singapore
date_default_timezone_set('Asia/Singapore');

// Start session to manage user login state
session_start();

// Redirect to signin.php if the user is not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: signin.php");
    exit();
}

// Include database connection
include_once("db_connection.php");

// Get the current user's ID from session
$user_id = $_SESSION["user_id"];

// Get the current date
$current_date = date("Y-m-d");

// Function to get the current time
function getCurrentTime()
{
    return date("H:i:s");
}

// Function to check if the user has already timed in or out
function checkTimedInOut($conn, $user_id, $current_date, $type)
{
    $query = "SELECT * FROM user_logs WHERE user_id='$user_id' AND DATE($type) = '$current_date'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the time in button is clicked
    if (isset($_POST['time_in'])) {
        if (checkTimedInOut($conn, $user_id, $current_date, 'time_in')) {
            // Display message if the user has already timed in and out today
            $message = "You have already timed in and out today";
        } else {
            // Insert the time in record into user_logs table
            $current_time = getCurrentTime();
            $insert_query = "INSERT INTO user_logs (user_id, time_in) VALUES ('$user_id', '$current_time')";
            mysqli_query($conn, $insert_query);
            // Redirect to index.php
            header("Location: user_logs.php");
            exit();
        }
    }

    // Check if the time out button is clicked
    if (isset($_POST['time_out'])) {
        if (checkTimedInOut($conn, $user_id, $current_date, 'time_out')) {
            // Display message if the user has already timed out today
            $message = "You have already timed out today";
        } else {
            // Update the time_out field for the current date and user
            $current_time = getCurrentTime();
            $update_query = "UPDATE user_logs SET time_out='$current_time' WHERE user_id='$user_id' AND DATE(time_in) = '$current_date'";
            mysqli_query($conn, $update_query);
            // Redirect to index.php
            header("Location: user_logs.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log Time</title>
	<!-- Link to Font Awesome for icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<!-- Link to Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		.time-status-green {
			color: green;
		}

		.time-status-red {
			color: red;
		}
	</style>
</head>

<body>
	<div class="container">
		<p>Today's Date: <?php echo $current_date; ?></p>
		<?php
$hasTimedIn = checkTimedInOut($conn, $user_id, $current_date, 'time_in');
$hasTimedOut = checkTimedInOut($conn, $user_id, $current_date, 'time_out');
?>

		<?php
if ($hasTimedIn && $hasTimedOut) {
    ?>
		<h1 class="time-status-green">You are OK for today</h1>
		<?php
} elseif ($hasTimedIn) {
    ?>
		<form method="post">
			<button type="submit" name="time_out" class="btn btn-danger">
				<i class="fas fa-sign-out-alt"></i> Time Out
			</button>
		</form>
		<?php
} else {
    ?>
		<form method="post">
			<button type="submit" name="time_in" class="btn btn-primary">
				<i class="fas fa-sign-in-alt"></i> Time In
			</button>
		</form>
		<?php
}
?>






		<h1>Welcome to Log Time Page</h1>
		<?php if(isset($message)) { ?>
		<!-- Display message if the user has already timed in and timed out today -->
		<div class="alert alert-danger" role="alert">
			<?php echo $message; ?>
		</div>
		<?php } ?>

		<!-- Form to handle time in and time out button submission -->





		<!-- Display time in and time out for today -->
		<div class="row mt-4">
			<div class="col">
				<?php
    // Check if there are records in user_logs for the current user and date
    $check_query = "SELECT * FROM user_logs WHERE user_id='$user_id' AND DATE(time_in) = '$current_date'";
$result = mysqli_query($conn, $check_query);
$row = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) > 0) {
    ?>
				<h4>Time In Today:
					<?php echo date("h:i A", strtotime($row['time_in'])); ?>
				</h4>
				<?php if (!empty($row['time_out'])) { ?>
				<h4>Time Out Today:
					<?php echo date("h:i A", strtotime($row['time_out'])); ?>
				</h4>
				<?php } else { ?>
				<h4>Time Out Today: Not timed out yet</h4>
				<?php } ?>
				<?php } else { ?>
				<!-- Display error message if no data found -->
				<div class="alert alert-warning" role="alert">
					No data found in user_logs.
				</div>
				<?php } ?>
			</div>
		</div>

		<!-- Large button stretched to the entire row -->
		<div class="row mt-4">
		<div class="col">
    <button class="btn btn-primary btn-lg btn-block" onclick="window.location.href='/';">Proceed to HomePage</button>
</div>

		</div>

		<div class="row mt-4">
			<div class="col">
				<a href="user_logs.php" class="btn btn-success btn-lg btn-block">
					<i class="fas fa-history"></i> View User Log History
				</a>
			</div>
		</div>
	</div>
</body>

</html>