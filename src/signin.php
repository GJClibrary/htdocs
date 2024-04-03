<?php


// Get host and URI
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$src = 'https://' . $host . $uri;

?>

<?php
// Start session to manage user login state
session_start();

// Include database connection
include_once("db_connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query to check if the entered email and password match any user in the database
    $sql = "SELECT * FROM users WHERE emailaddress='$email' AND password='$password'";
    $sql_email = "SELECT * FROM users WHERE emailaddress='$email'";
    $result = mysqli_query($conn, $sql);

    // Check if a user with the entered email and password exists in the database
    if (mysqli_num_rows($result) == 1) {
        // Fetch user data
        $user = mysqli_fetch_assoc($result);

        // Generate a unique token
        $token = bin2hex(random_bytes(32)); // Generates a 64-character random hexadecimal string
        
        // Update the user's token in the database
        $updateSql = "UPDATE users SET token='$token' WHERE id=" . $user['id'];
        mysqli_query($conn, $updateSql);

        // Set session variables including the user's first name
        $_SESSION["loggedin"] = true;
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["token"] = $token;
        $_SESSION["firstname"] = $user['firstname']; // Set the user's first name

        // Redirect to log_time.php after successful login
        header("Location: log_time.php");
        exit();
    } else {
        // Check if email exists in the database
        $result_email = mysqli_query($conn, $sql_email);
        if (mysqli_num_rows($result_email) == 1) {
            // If email exists but password is incorrect, display error message
            $error_message_pass_incorrect = "Password for $email is incorrect.";
        } else {
            // If email does not exist in the database, display general error message
            $error_message = "No email found. Please try again.";
        }
    }
}
?>



<?php include("components/head.php"); ?>

<!-- Navbar-->
<header class="header">
	<nav class="navbar navbar-expand-lg navbar-light py-3">

		<div class="container d-flex justify-content-between align-items-center">
			<!-- Logo and Text -->
			<a href="<?php echo "/"; ?>"
				class="navbar-brand d-flex align-items-center">
				<img src="public/images/gjc_logo.png" alt="GJC Logo" class="logo-image mr-1" width="34">
				<span class="ml-1">GJC</span>
			</a>
			<!-- Register Button -->
			<a href="<?php echo "$src/register.php"; ?>"
				class="btn btn-primary">Register</a>
		</div>
	</nav>
</header>

<div class="container">
	<div class="row py-5 mt-4  align-items-center">
		<div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
			<img src="<?php echo "$src/public/images/logo.png"; ?>"
				alt="" class="img-fluid mb-3 d-none d-md-block">
			<h1 style="margin-top: -50px;">Welcome Back GJCian</h1>
			<p class="text-muted mb-0">Quote of the Day.</p>
			<p class="font-italic text-muted mb-0">
				Today is hard, tomorrow will be worse, but the day after tomorrow will be sunshine. What you do today
				can improve all your tomorrows.</p>
		</div>
		<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
			<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
				<path
					d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
			</symbol>
			<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
				<path
					d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
			</symbol>
			<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
				<path
					d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
			</symbol>
		</svg>



		<!-- Registration Form -->
		<div class="col-md-7 col-lg-6 ml-auto mt-5">
			<!-- Display error message if any -->
			<form action="signin.php" method="POST">
				<div class="row">

					<!-- Email Address -->
					<div class="input-group col-lg-12 mb-4">
						<div class="input-group-prepend">
							<span class="input-group-text bg-white px-4 border-md border-right-0">
								<i class="fa fa-envelope text-muted"></i>
							</span>
						</div>
						<input id="email" type="email" name="email" placeholder="Email Address"
							class="form-control bg-white border-left-0 border-md <?php echo isset($error_message) ? 'error-outline' : ''; ?>"
							value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
							required>
					</div>

					<!-- Password -->
					<div class="input-group col-lg-12 mb-4">
						<div class="input-group-prepend">
							<span class="input-group-text bg-white px-4 border-md border-right-0">
								<i class="fa fa-lock text-muted"></i>
							</span>
						</div>
						<input id="password" type="password" name="password" placeholder="Password"
							class="form-control bg-white border-left-0 border-md <?php echo isset($error_message_pass_incorrect) ? 'error-outline' : ''; ?>"
							required>
						<div class="invalid-feedback">
							Please enter a password.
						</div>
					</div>

					<?php if (isset($error_message_pass_incorrect)) : ?>
					<div class="col-lg-12 align-items-center text-center">
						<div class="alert alert-warning alert-dismissible fade show align-items-center" role="alert">
							<div class="row">
								<div class="col-auto">
									<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
										aria-label="Danger:">
										<use xlink:href="#exclamation-triangle-fill" />
									</svg>
								</div>
								<?php echo $error_message_pass_incorrect; ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
					</div>

					<?php endif; ?>

					<?php if (isset($error_message)) : ?>

					<div class="col-lg-12 align-items-center text-center">
						<div class="alert alert-danger alert-dismissible fade show align-items-center" role="alert">
							<div class="row">
								<div class="col-auto">
									<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
										aria-label="Danger:">
										<use xlink:href="#exclamation-triangle-fill" />
									</svg>
								</div>
								<?php echo $error_message; ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
					</div>

					<?php endif; ?>


					<!-- Submit Button -->
					<div class="form-group col-lg-12 mx-auto mb-0">
						<button type="submit" class="btn btn-primary btn-block py-2">
							<span class="font-weight-bold">Signin</span>
						</button>
					</div>

					<!-- Divider Text -->
					<div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
						<div class="border-bottom w-100 ml-5"></div>
						<span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
						<div class="border-bottom w-100 mr-5"></div>
					</div>

					<!-- Social Login -->
					<div class="form-group col-lg-12 mx-auto">
						<a href="<?php echo "$src/login.php"; ?>"
						style="cursor: zoom-in"
						class="disabled btn btn-success btn-block py-2 btn-facebook">
							<i class="fab fa-google mr-2"></i>
							<span class="font-weight-bold">Continue with Google</span>
						</a>
					</div>

					<!-- Already Registered -->
					<div class="text-center w-100">
						<p class="text-muted font-weight-bold">Doesn't have an account? <a
								href="<?php echo "$src/register.php"; ?>"
								class="text-primary ml-2">Register Now</a></p>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

</div>
<?php include("components/main-end.php"); ?>