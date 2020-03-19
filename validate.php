<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
$username = $_POST['username'];
$password = $_POST['password'];

try {
    require_once 'db.php';
    $sql = "SELECT userId, password FROM users WHERE username = :username";

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    if (!password_verify($password, $user['password'])) {
        header('location:login.php?invalid=true');

        exit();
    } else {
        // allows us to read/write from session
        session_start();

        // create a session variable called "userId" and fill it from the id in our login query above
        $_SESSION['userId'] = $user['userId'];

        // stores username to store in navigation bar
        $_SESSION['username'] = $username;

        // redirect to home-page page
        header('location:home-page.php');
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
