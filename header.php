<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<nav class="navbar navbar-expand-md bg-custom">



    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <?php

            //check current user session
            session_start();

            //connect to the database
            require_once 'db.php';
            $sql = "SELECT imageName, MAX(imageId) FROM headerImage GROUP BY imageId DESC LIMIT 1;";

            //prepare and execute
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $images = $cmd->fetch();

            $image = $images['imageName'];

            //display my photo if there is one

         if(!empty($image)) {
                echo '<div>
                    <img src="img/headerImg/' . $image . '" alt="Header Photo" width="200px" height="100px" />
                </div>';
         }
          else{
              echo 'Assignment 2';
          }





            //sql query to select all from users
            $query = "SELECT * FROM pages;";

            //prepare and execute
            $cmd = $db->prepare($query);
            $cmd->execute();

            //fetch all the data and store in users
            $pages = $cmd->fetchAll();

            foreach ($pages as $value) {
                if (empty($_SESSION['userId'])) {

                    echo     '<ul class="navbar-nav">
                           <li class="nav-item">
                            <a class="nav-link" href="home-page.php?pageId=' . $value['pageId'] . '">' . $value['pName'] . '</a>
                           </li></ul>';

                }


            }

            //if userId is not empty show Administrators in nav bar
            if(!empty($_SESSION['userId'])) {
                echo '<ul class="navbar-nav">
                           <li class="nav-item">
                            <a class="nav-link" href="admin-list.php">Administrators</a>
                           </li>
                           <li class="nav-item">
                            <a class="nav-link" href="pages-list.php">Pages</a>
                           </li>
                           <li class="nav-item">
                            <a class="nav-link" href="header-image.php">Logo</a>
                           </li>
                                  </ul> ';
            }
            ?>
        </ul>
        <ul class="navbar-nav ml-auto">

            <?php
            //check current user session
            session_start();
            //if userId is not empty
            if(!empty($_SESSION['userId'])){
                //add users username and a logout button to nav bar
                echo '<li class="nav-item"><a class="nav-link" href="#">' . $_SESSION['username'] . '</a>
                <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>';

            }
            //if not in session add login and register to nav bar
            else{
                echo ' <li class="nav-item">
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
</body>