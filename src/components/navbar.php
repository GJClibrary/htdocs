<body>
	<div id="mySidebar" class="sidebar">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
		<a href="#">About</a>
		<a href="#">Services</a>
		<a href="#">Clients</a>
		<a href="#">Contact</a>
	</div>

	<div id="main">
		<nav class="navbar navbar-light bg-light">
			<div class="d-flex justify-content-between w-100">
				<div class="d-flex align-items-center">
					<button onclick="openNav()" class="openbtn btn-light">☰</button>
					<a href="/">
						<img src="public/images/gjc_logo.png" alt="GJC Logo" class="logo-image mr-1"
							style="width: 34px;">
					</a>
					<a class="navbar-brand" href="/">GJC</a>
				</div>
				<div class="text-center"> <!-- Added text-center class here -->
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search" aria-label="Search"
							aria-describedby="button-addon2">
						<div class="input-group-append">
							<button class="btn btn-secondary" type="button" id="button-addon2">
								<i class="fa-solid fa-search"></i>
							</button>
						</div>
					</div>
				</div>

				<?php if(isset($_SESSION['user_id'])): ?>
				<!-- User avatar -->
				<div class="d-flex align-items-center">
					<div class="profile-pic mr-2">
						<img src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745"
							alt="Profile Picture">
					</div>
					<form action="signout.php" method="post">
						<button type="submit" class="btn btn-primary mr-2 mt-2">Logout</button>
					</form>
				</div>

				<!-- <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu"> 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="profile-pic">
                            <img src="https://source.unsplash.com/250x250?girl" alt="Profile Picture">
                        </div>
                        <button class="btn btn-primary mr-2 mt-2" onclick="window.location.href='<?php echo "http://$host$uri/src/signin.php"; ?>'">Login</button>
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#"><i class="fas fa-sliders-h fa-fw"></i> Account</a></li>
					<li><a class="dropdown-item" href="#"><i class="fas fa-cog fa-fw"></i> Settings</a></li>
					<li>
						<hr class="dropdown-divider">
					</li>
					<li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a></li>
				</ul>
				</li>
				</ul> -->
				<?php else: ?>
				<!-- Login button -->
				<div>

				</div>
				<?php endif; ?>
			</div>

			<div class="collapse sidebar-collapse" id="basic-navbar-nav">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item"><a class="nav-link text-dark"
							href="<?php echo "http://$host$uri/src/signin.php"; ?>">Signin</a>
					</li>
					<li class="nav-item"><a class="nav-link text-dark"
							href="<?php echo "http://$host$uri/src/register.php"; ?>">Register</a>
					</li>
					<li class="nav-item"><a class="nav-link text-dark"
							href="<?php echo "http://$host$uri/src/team.php"; ?>">Team</a>
					</li>
					<li class="nav-item"><a class="nav-link text-dark"
							href="<?php echo "http://$host$uri/src/home.php"; ?>">Home</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>