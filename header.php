<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mitchell's Test Site - <?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" />

</head>
<body class="d-flex flex-column">
<main id="page-content">

    <!-- navbar from https://www.w3schools.com/bootstrap4/bootstrap_navbar.asp -->
    <nav class="navbar navbar-expand-md bg-custom navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="home-page.php">Mitchell's Test Site</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="admin-page.php">Admin Page</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php
                // access current session to check if user is authenticated
                session_start();
                // If user is logged in then display logout button as well as the user's username. (In the nav bar)
                if (!empty($_SESSION['userId'])) {
                    echo '<li class="nav-item"><a class="nav-link" href="#">' . $_SESSION['username'] . '</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
                }
                // If the user is not logged in then display register and login buttons. (In the nav bar)
                else {
                    echo '<li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>';
                }
                ?>
            </ul>
        </div>
    </nav>


