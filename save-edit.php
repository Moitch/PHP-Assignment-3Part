<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="scripts/scripts.js" type="text/javascript"></script>
    <title>Saving...</title>
</head>
<body>

<?php

// store form inputs in variables
$username = $_POST['username'];
$oldpassword = $_POST['oldpassword'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$userId = $_POST['userId'];
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
if($ok) {
    try {
        // connect to my database
        require_once 'db.php';
        $sql = "SELECT * FROM users WHERE userId = :userId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
        $cmd->execute();
        $user = $cmd->fetch();


        if (!password_verify($oldpassword, $user["password"])) {
            // the user has entered a invalid password
            header("location: login.php");
            exit();

        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE users set username = :username, password = :password WHERE userId = :userId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
            $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
            $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
            $cmd->execute();

            // disconnect
            $db = null;

            // redirect to admin list page after updating
            header('location:admin-list.php');

        } // If for some reason we fail to save the user, give user error page.
    }
    catch (Exception $e) {
        header('location:error.php?id='.$userId);
        exit();
    }
}
else
    header('location:admin-page.php');
?>

</body>
</html>