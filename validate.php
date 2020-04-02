<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
// Grabs the username and password values from login
$username = $_POST['username'];
$password = $_POST['password'];

try {
    require_once 'db.php';
    // Checks the database to see if the user is in the database
    $sql = "SELECT userId, password FROM users WHERE username = :username";

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();
    // If the username or password is wrong then tell the user and exit database.
    if (!password_verify($password, $user['password'])) {
        header('location:login.php?invalid=true');

        exit();
    }
    // If the username and password are correct then store the information into the session variables
    // to display in the nav bar. Then redirect to home page.
    else {
        session_start();

        $_SESSION['userId'] = $user['userId'];

        $_SESSION['username'] = $username;

        header('location:admin-list.php');
    }

    $db = null;
}
catch (Exception $e) {
    header('location:error.php');
    exit();
}
?>

</body>
</html>
