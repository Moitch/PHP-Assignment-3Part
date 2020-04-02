    <?php


    require_once('header.php');
    // starts session
    session_start();

    // make this page private, if user isn't logged in, redirect them to login.
    require_once 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload a new Header Image</title>
</head>
<body>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image">
        <input type="submit" name="submit" value="Upload">
    </form>

    <?php
    require_once 'footer.php';
            ?>

</body>