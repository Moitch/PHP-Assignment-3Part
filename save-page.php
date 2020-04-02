<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving...</title>
</head>
<body>

<?php

// store form inputs in variables
$pageId = $_GET['pageId'];
$pName = $_POST['pName'];
$content = $_POST['content'];

$ok = true;

// validate inputs
if (empty($pName)) {
    echo 'Page title is required<br />';
    $ok = false;
}

if (empty($content)) {
    echo 'Password is required<br />';
    $ok = false;
}

if ($ok) {

    try {
        // connect to my database
        require_once 'db.php';

        $sql = "SELECT * FROM pages WHERE pName = :pName";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':pName', $pName, PDO::PARAM_STR, 50);
        $cmd->execute();
        $page = $cmd->fetch();

        if (empty($page)) {
            // set up & run insert
            $sql = "INSERT INTO pages (pName, content) VALUES (:pName, :content);";

            $cmd = $db->prepare($sql);
            $cmd->bindParam(':pName', $pName, PDO::PARAM_STR, 50);
            $cmd->bindParam(':content', $content, PDO::PARAM_STR, 255);
            $cmd->bindParam(':page_ID', $page_ID, PDO::PARAM_INT);

            $cmd->execute();


            // disconnect


            $db = null;
            // redirect to login page after registering
//        header('location:pages-list.php');
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