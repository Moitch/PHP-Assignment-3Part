<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
</head>
<body>
<!--LOAD HEADER-->
<?php
require_once ('header.php');
// starts session
session_start();

// make this page private, if user isn't logged in, redirect them to login.
require_once 'auth.php';

?>

<p>This is the admin only page, Welcome fellow admin!</p>

</body>
</html>
<!--LOAD FOOTER-->
<?php
require_once 'footer.php';
?>