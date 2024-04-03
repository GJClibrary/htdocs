

<link rel="stylesheet"
  href="<?php echo "$src/public/styles/globals.css"; ?>">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet"
  href="<?php echo "$src/public/styles/font-awesome/fontawesome.min.css"; ?>">
<link rel="stylesheet"
  href="<?php echo "$src/public/styles/font-awesome/brands.min.css"; ?>">
<link rel="stylesheet"
  href="<?php echo "$src/public/styles/font-awesome/solid.min.css"; ?>">

<style>
  .hero-section {
    background-image: url('src/public/images/lib-green.png');
    background-size: 100% auto;
    /* Specify the width to cover the entire width and auto for the height */
    background-position: center;
    /* Centers the background image */
    color: white;
    /* Ensures text is visible on the background */
    padding: 50px;
    /* Adjust padding as needed */
  }


  .baclground-library {
    background-image: url('src/public/images/lib.png');
    background-size: 100% auto;
    /* Specify the width to cover the entire width and auto for the height */
    background-position: center;
    /* Centers the background image */
    color: white;
    /* Ensures text is visible on the background */
    padding: 50px;
    /* Adjust padding as needed */
  }

  .hero-section h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
  }

  .hero-section h2 {
    font-size: 1.5rem;
    margin-bottom: 40px;
  }

  .sidebar {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
  }

  .sidebar a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
  }

  .sidebar a:hover {
    color: #f1f1f1;
  }

  .sidebar .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
  }

  .openbtn {
    font-size: 20px;
    cursor: pointer;
    color: gray;
    padding: 10px 15px;
    border: none;
  }

  .openbtn:hover {
    background-color: #444;
  }

  #main {
    transition: margin-left .5s;
  }

  /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
  @media screen and (max-height: 450px) {
    .sidebar {
      padding-top: 15px;
    }

    .sidebar a {
      font-size: 18px;
    }
  }

  .cd__main {
    display: block !important;
    background: linear-gradient(to right, #00b09b, #96c93d) !important;
    min-height: 720px;
  }

  /* Profile Picture */
  .profile-pic {
    display: inline-block;
    vertical-align: middle;
    width: 38px;
    height: 38px;
    overflow: hidden;
    border-radius: 50%;
    margin-top: 5px;
  }

  .profile-pic img {
    width: 100%;
    height: auto;
    object-fit: cover;
  }

  .profile-menu .dropdown-menu {
    right: 0;
    left: unset;
  }

  .profile-menu .fa-fw {
    margin-right: 10px;
  }

  .toggle-change::after {
    border-top: 0;
    border-bottom: 0.3em solid;
  }

  .elegant-paragraph {
        font-family: 'Times New Roman', Times, serif;
        font-size: 1.1rem;
        line-height: 1.6;
        color: #333;
        margin-bottom: 20px;
    }
    .tag {
  border: 1px solid #333; /* Dark grey border */
  background-color: #E0E0E0; /* Light grey background */
  color: #333; /* Dark grey text */
  padding: 2px 3px;
  font-size: 16px;
  cursor: pointer;
  font-weight: bold;
  border-radius: 5px;
  font-family: 'Roboto', sans-serif; /* Specify Roboto font */
}

.tag:hover {
  background: #FFF; /* White background on hover */
  color: #000; /* Black text on hover */
}



  
</style>
</head>