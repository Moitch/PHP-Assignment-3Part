<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving...</title>
</head>
<body>

<?php

// store form inputs in variables
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validate inputs
if (empty($username)) {
    echo 'Username is required<br />';
    $ok = false;
}

if (empty($password)) {
    echo 'Password is required<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Passwords must match<br />';
    $ok = false;
}

if ($ok) {
    // hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);


    try {
        // connect to my database
        require_once 'db.php';

        // Goes into database and checks to see if the username is already registered.
        $sql = "SELECT * FROM users WHERE userId = :userId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->execute();
        $user = $cmd->fetch();
        // If it is already there then it will not add it to the database again.
        if (!empty($user)) {
            $sql = "UPDATE users set username = :username WHERE userId = :userId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
            $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
            $cmd->execute();

            // disconnect
            $db = null;

            // redirect to admin list page after updating
            header('location:admin-list.php');
        }
        // If it isn't already there then add it to the database.
        else {
            // set up & run insert
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
            $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
            $cmd->execute();

            // disconnect
            $db = null;

            // redirect to login page after registering
            header('location:login.php');
        }


    }
    // If for some reason we fail to save the user, give user error page.
    catch (Exception $e) {
        header('location:error.php');
        exit();
    }
}
?>

</body>
</html>