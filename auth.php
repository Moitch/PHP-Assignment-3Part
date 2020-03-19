<?php
// redirect user to login page if not logged in.
if (empty($_SESSION['userId'])) {
    header('location:login.php');
    exit();
}
?>