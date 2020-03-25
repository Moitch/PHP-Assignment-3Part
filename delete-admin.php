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
$artistId = $_GET['userId'];

try {
    // connect
    require_once 'db.php';

    // create the SQL DELETE command
    $sql = "DELETE FROM users WHERE userId = :userId";

    // pass the userId parameter
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);

    // execute the deletion
    $cmd->execute();

    // disconnect
    $db = null;

    // redirect back to updated artists-list page
    header('location:admin-list.php');
}
catch (Exception $e) {
    header('location:error.php');
    exit();
}

?>

</body>
</html>