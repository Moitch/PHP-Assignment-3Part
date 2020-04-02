<?php
$title = 'Admin List';
require_once ('header.php');

session_start();

?>

    <h1>Admin List</h1>


<?php

try {
    // Creates SQL Select statement and grabs what it finds.
    require_once 'db.php';

    $query = "SELECT * FROM users;";

    $cmd = $db->prepare($query);
    $cmd->execute();

    $user = $cmd->fetchAll();

    echo '<table class="table table-striped table-hover"><thead><th>Username</th><th></th></thead>';
    // Create table rows for each user.
    foreach ($user as $value) {

        echo '<tr>';
        // If the user is logged in, allow them to edit users
        if (!empty($_SESSION['userId'])) {
            echo '<td><a href="edit-admin.php?userId=' . $value['userId'] . '">' . $value['username'] . '</a></td>';
        }
        else {
            echo '<td>' . $value['username'] . '</td>';
        }


        // only show delete to authenticated users
        if (!empty($_SESSION['userId'])) {
            echo '<td><a href="confirm-delete.php?userId=' . $value['userId'] . '" class="btn btn-danger"
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