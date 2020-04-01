<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting...</title>
</head>
<body>

<?php
// auth check
session_start();

// make this page private
require_once 'auth.php';


// parse the pageId
$pageId = $_GET['pageId'];

try {
    require_once 'db.php';


    // create the SQL DELETE command
        $sql = "DELETE FROM pages WHERE pageId = :pageId";

        // pass the userId parameter
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);

        // execute the deletion
        $cmd->execute();

        // disconnect
        $db = null;

        // redirect back to updated admin-list page
        header('location:pages-list.php');
    }

catch (Exception $e) {
    header('location:error.php');
    exit();
}

?>

</body>
</html>