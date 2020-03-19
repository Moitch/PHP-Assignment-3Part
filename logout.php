<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
// Destroys all session variables and then redirects the user to login page.
session_start();
session_unset();
session_destroy();
header('location:login.php');
?>

</body>
</html>
