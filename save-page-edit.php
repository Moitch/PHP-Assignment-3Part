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

        // If it is already there then it will not add it to the database again.
        if (!empty($page)) {
            $sql = "UPDATE pages set pName = :pName, content = :content WHERE pageId = :pageId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':pName', $pName, PDO::PARAM_STR, 50);
            $cmd->bindParam(':content', $content, PDO::PARAM_STR, 255);
            $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);

            $cmd->execute();

            // disconnect
            $db = null;

            echo $pageId;
            echo $pName;
            echo $content;

            header('location:pages-list.php');

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