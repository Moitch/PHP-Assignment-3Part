<?php
$title = 'Page List';
require_once ('header.php');

session_start();

?>

    <h1>Page List</h1>


<?php

try {
    require_once 'db.php';

    $query = "SELECT * FROM pages;";

    $cmd = $db->prepare($query);
    $cmd->execute();

    $page = $cmd->fetchAll();

    echo '<table class="table table-striped table-hover"><thead><th>Username</th><th></th></thead>';
    // Create table rows for each user.
    foreach ($page as $value) {

        echo '<tr>';
        // If the user is logged in, allow them to edit users
        if (!empty($_SESSION['userId'])) {
            echo '<td><a href="edit-page.php?pageId=' . $value['pageId'] . '">' . $value['pName'] . '</a></td>';
        }
        else {
            echo '<td>' . $value['pName'] . '</td>';
        }


        // only show delete to authenticated users
        if (!empty($_SESSION['userId'])) {
            echo '<td><a href="delete-page.php?pageId=' . $value['pageId'] . '" class="btn btn-danger"
                onclick="return confirmDelete();">Delete</a></td>';
        }

        echo '</tr>';
    }

    echo '</table>';
    // disconnect
    $db = null;
}
// if error is found send user to error.php
catch (Exception $e) {
    header('location:error.php');
    exit();
}

require_once 'footer.php';
?>