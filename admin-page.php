<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
</head>
<body>

<?php
// auth check
session_start();

// make this page private
require_once 'auth.php';
if (empty($_SESSION['userId'])) {
    header('location:login.php');
    exit();
}
?>

<p>This is the admin only page, Welcome fellow admin!</p>

</body>
</html>
