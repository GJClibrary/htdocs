

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css"> -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/themes/github.css">
    <link rel="stylesheet" href="assets/app.css">
    <link rel="stylesheet" href="<?php echo "http://$host$uri/public/styles/globals.css"; ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo "http://$host$uri/public/styles/font-awesome/fontawesome.min.css"; ?>">
    <link rel="stylesheet" href="<?php echo "http://$host$uri/public/styles/font-awesome/brands.min.css"; ?>">
    <link rel="stylesheet" href="<?php echo "http://$host$uri/public/styles/font-awesome/solid.min.css"; ?>">
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
    <style>
      .hero-section {
    background-image: url('src/public/images/lib-green.png');
    background-size: 100% auto; /* Specify the width to cover the entire width and auto for the height */
    background-position: center; /* Centers the background image */
    color: white; /* Ensures text is visible on the background */
    padding: 50px; /* Adjust padding as needed */
}


.baclground-library {
    background-image: url('src/public/images/lib.png');
    background-size: 100% auto; /* Specify the width to cover the entire width and auto for the height */
    background-position: center; /* Centers the background image */
    color: white; /* Ensures text is visible on the background */
    padding: 50px; /* Adjust padding as needed */
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
    .sidebar {padding-top: 15px;}
    .sidebar a {font-size: 18px;}
    }

    .custom-cursor-pointer {
      cursor: pointer;
    }
    .error-outline {
        border-color: #ff0000 !important; /* Red outline color */
        box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25) !important; /* Red outline effect */
    }
    .book-image {
            max-width: 200px;
            height: auto;
        }

        .social-link {
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            border-radius: 50%;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .social-link:hover,
        .social-link:focus {
            background: #ddd;
            text-decoration: none;
            color: #555;
        }

        .progress {
            height: 10px;
        }

        .italic-bold {
            font-style: italic;
            font-weight: 700;
            vertical-align: baseline;
        }
</style>
</head>