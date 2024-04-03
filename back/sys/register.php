

<?php

include_once("db_connection.php");
include_once("initialize.php");

// Initialize a variable to store success message and error message
$success_message = "";
$error_message = "";

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phone"];
    $role = $_POST["role"];
    $password = $_POST["password"]; // Remember to hash the password before storing it in the database for security reasons

    // Perform validation
    if(empty($firstname) || empty($lastname) || empty($email) || empty($phonenumber) || empty($role) || empty($password)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } elseif(strlen($password) < 6) {
        $error_message = "Password must be at least 6 characters long.";
    } else {
        // Check for duplicate email or phone number
        $check_query = "SELECT * FROM users WHERE emailaddress = '$email' OR phonenumber = '$phonenumber'";
        $check_result = mysqli_query($conn, $check_query);
        if(mysqli_num_rows($check_result) > 0) {
            $error_message = "Email or phone number already exists.";
        } else {
            // Insert data into users table
            $sql = "INSERT INTO users (firstname, lastname, emailaddress, phonenumber, role, password) VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$role', '$password')";

            if(mysqli_query($conn, $sql)) {
                // Set success message
                $success_message = "Registration successful! You can now sign in.";
                // Redirect to successful.php
                header("Location: successful.php");
                exit();
            } else {
                $error_message =  mysqli_error($conn);
            }
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
            <a href="<?php echo "http://$host/GJCLIBRARY"; ?>"
                class="navbar-brand d-flex align-items-center">
                <img src="public/images/gjc_logo.png" alt="GJC Logo" class="logo-image mr-1" width="34">
                <span class="ml-1">GJC</span>
            </a>

            <!-- Signin Button -->
            <a href="<?php echo $signin_url; ?>"
                class="btn btn-primary">Signin</a>
        </div>
    </nav>
</header>


<div class="container">



    <div class="row py-5 mt-4 align-items-center">
        <!-- For Demo Purpose -->
        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">

            <img src="<?php echo "http://$host$uri/public/images/logo.png"; ?>"
                alt="" class="img-fluid mb-3 d-none d-md-block">

            <h1 style="margin-top: -50px;">Create a new account</h1>
            <p class="text-muted mb-0">By clicking Sign Up, you agree to our Terms, Privacy Policy and Cookies Policy.
                You may receive SMS Notifications from us and can opt out any time.

        </div>

        <!-- Registeration Form -->
        <div class="col-md-7 col-lg-6 ml-auto">
            <form method="post"
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="row">

                    <!-- First Name -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="firstName" type="text" name="firstname" placeholder="First Name"
                            class="form-control bg-white border-left-0 border-md" required
                            value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>">
                    </div>

                    <!-- Last Name -->
                    <div class="input-group col-lg-6 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="lastName" type="text" name="lastname" placeholder="Last Name"
                            class="form-control bg-white border-left-0 border-md" required
                            value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : ''; ?>">

                    </div>

                    <!-- Email Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                        <input id="email" type="email" name="email" placeholder="Email Address"
                            class="form-control bg-white border-left-0 border-md" required
                            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">


                    </div>


                    <!-- Phone Number -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-phone-square text-muted"></i>
                            </span>
                        </div>
                        <select id="countryCode" name="countryCode" style="max-width: 80px"
                            class="custom-select form-control bg-white border-left-0 border-md h-100 font-weight-bold text-muted">
                            <option value="">+63</option> <!-- Set the default value to +63 -->
                        </select>
                        <input id="phoneNumber" type="tel" name="phone" placeholder="Phone Number"
                            class="form-control bg-white border-md border-left-0 pl-3" required pattern="\d{10}"
                            title="Please enter a valid Philippine Phone Number"
                            value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">

                    </div>


                    <!-- Role -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fas fa-briefcase text-muted"></i>
                            </span>
                        </div>
                        <select id="role" name="role"
                            class="form-control custom-select bg-white border-left-0 border-md" required>
                            <option value="">Choose your account type</option>
                            <option value="student" <?php echo (isset($_POST['role']) && $_POST['role'] === 'student') ? 'selected' : ''; ?>>Student
                            </option>
                            <option value="teacher" <?php echo (isset($_POST['role']) && $_POST['role'] === 'teacher') ? 'selected' : ''; ?>>Teacher
                            </option>
                            <option value="staff" <?php echo (isset($_POST['role']) && $_POST['role'] === 'staff') ? 'selected' : ''; ?>>Staff
                            </option>
                            <option value="developer" <?php echo (isset($_POST['role']) && $_POST['role'] === 'developer') ? 'selected' : ''; ?>>Developer
                            </option>
                        </select>
                    </div>


                    <!-- Password -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="password" type="password" name="password" placeholder="Password"
                            class="form-control bg-white border-left-0 border-md" required>
                    </div>

                    <!-- Password Confirmation -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="passwordConfirmation" type="password" name="passwordConfirmation"
                            placeholder="Confirm Password" class="form-control bg-white border-left-0 border-md"
                            required>
                    </div>

                    <div class="form-group col-lg-12 form-check mx-auto">
                        <div class="ml-4">
                            <!-- Added custom class to checkbox -->
                            <input type="checkbox" class="form-check-input custom-cursor-pointer" id="agreeCheckbox"
                                checked required>
                        </div>
                        <div class="ml-3 text-center mb-n3">
                            <label class="form-check-label" for="agreeCheckbox"></label>
                            <p id="termsLink" class="text-muted font-weight-bold">
                                By clicking Sign Up, you agree to our Terms, Privacy Policy and Cookies Policy.
                            </p>
                        </div>




                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions</h5>
                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"
                                            aria-label="Close">X</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Content for the popup goes here -->
                                        By accessing and borrow books from GJC Library, you confirm that you are in
                                        agreement with and bound
                                        by the terms of service contained in the Terms & Conditions outlined below.
                                        These terms apply to the
                                        entire website and any email or other type of communication between you and
                                        General De Jesus College.
                                    </div>
                                    <div class="modal-body">
                                        You represent and warrant that you are of legal age to form a binding contract.
                                        If you are not able to
                                        form a binding contract (this means, in most jurisdictions, you are not yet 18
                                        years old), we strongly
                                        encourage librarians, teachers and parents to spend time online with
                                        children/students and to
                                        appropriately monitor their online activities, as such we recommend informing
                                        parents are aware of the
                                        Services. Please protect privacy by instructing them to never provide personal
                                        information on this site
                                        or any other, or within any software registration process. And make sure the
                                        students understand basic
                                        copyright issues, i.e., don’t cut and paste and reuse the material in a
                                        commercial manner.
                                    </div>
                                    <div class="modal-body">
                                        If you register to use any of the Services, you will create an account, and
                                        select a password and
                                        username. You promise that the registration information you provide will be
                                        accurate, complete, and
                                        up-to-date, and you understand that failure to do so may result in suspension of
                                        your Account. You may
                                        not select for your username a name that you don’t have the rights to use or
                                        another person’s name with
                                        the intent to impersonate that person.
                                    </div>
                                    <div class="modal-body">
                                        You promise to only use the Services for your personal, non-commercial use, and
                                        only in a manner that
                                        complies with all laws that apply to you. If your use of the Services is
                                        prohibited by applicable laws,
                                        then you aren’t authorized to use the Services. We can’t and won’t be
                                        responsible for you using the
                                        Services in away that breaks the law.
                                    </div>
                                    <div class="modal-body">
                                        You are also responsible for maintaining the confidentiality of your Account
                                        password and for the
                                        security of your Account, and you will notify GJC Library immediately of any
                                        actual or suspected loss,
                                        theft, or unauthorized use of your Account or Account password.
                                    </div>
                                    <div class="modal-body">
                                        Any violation of the Terms of Use by anyone using the Services under your
                                        Account (or otherwise under
                                        your authority or permission) may be deemed a violation by you, irrespective of
                                        whether the violation
                                        is with or without your consent.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"
                                            aria-label="Close">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error message -->
                    <?php if (!empty($error_message)) : ?>
                    <div class="col-lg-12 mb-4 text-center">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $error_message; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <?php endif; ?>


                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button type="submit" class="btn btn-primary btn-block py-2">
                            <span class="font-weight-bold">Create your account</span>
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
						<a href="<?php echo "http://$host$uri/login.php"; ?>"
						
						class="btn btn-success btn-block py-2 btn-facebook">
							<i class="fab fa-google mr-2"></i>
							<span class="font-weight-bold">Continue with Google</span>
						</a>
					</div>

                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Already Registered? 
                        <a href="<?php echo $signin_url; ?>"
                                class="text-primary ml-2">Signin</a></p>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<?php include("components/scripts.php"); ?>
</div>
<?php include("components/main_end.php"); ?>