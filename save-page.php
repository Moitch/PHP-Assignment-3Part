<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving...</title>
</head>
<body>

<?php

// store form inputs in variables
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
            echo "Page with the name $pName exists already <br />";
        }
        // If it isn't already there then add it to the database.
        else {
            // set up & run insert
            $sql = "INSERT INTO pages (pName, content) VALUES (:pName, :content)";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':pName', $pName, PDO::PARAM_STR, 50);
            $cmd->bindParam(':content', $pName, PDO::PARAM_STR, 255);
            $cmd->execute();

            // disconnect
            $db = null;

            // redirect to login page after registering
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