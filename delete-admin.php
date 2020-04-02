<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
// auth check
session_start();

// make this page private
require_once 'auth.php';


// parse the userId
$userId = $_GET['userId'];
$password = $_POST['password'];

try {
    // connect
    require_once 'db.php';
    // Create select statement and fetch the row it found.
    $sql = "SELECT * FROM users WHERE userId = :userId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
    $cmd->execute();
    $user = $cmd->fetch();

    // verifies the password
    if (!password_verify($password, $user["password"])) {
            // the user has entered a invalid password
            header("location: error.php");
            exit();

    }

    else {

        // create the SQL DELETE command
        $sql = "DELETE FROM users WHERE userId = :userId";

        // pass the userId parameter
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);

        // execute the deletion
        $cmd->execute();

        // disconnect
        $db = null;

        // redirect back to updated admin-list page
        header('location:admin-list.php');
    }
}
catch (Exception $e) {
    header('location:error.php');
    exit();
}

?>

</body>
</html>