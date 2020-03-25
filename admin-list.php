<?php
$title = 'Admin List';
require_once ('header.php');

session_start();

require_once 'auth.php';

?>

    <h1>Admin List</h1>


<?php

try {
    require_once 'db.php';

    $query = "SELECT * FROM users;";

    $cmd = $db->prepare($query);
    $cmd->execute();

    $user = $cmd->fetchAll();

    echo '<table class="table table-striped table-hover"><thead><th>Username</th><th></th></thead>';

    // 5. Use a foreach loop to iterate (cycle) through all the values in the $artists variable.  Inside this loop, use an echo command to display the name of each person.  See https://www.php.net/manual/en/control-structures.foreach.php for details.
    foreach ($user as $value) {
        // could use this but it's unclear and error prone: echo $value[1];
        echo '<tr>';

        if (!empty($_SESSION['userId'])) {
            echo '<td><a href="edit-admin.php?userId=' . $value['userId'] . '">' . $value['username'] . '</a></td>';
        }
        else {
            echo '<td>' . $value['username'] . '</td>';
        }


        // only show delete to authenticated users
        if (!empty($_SESSION['userId'])) {
            echo '<td><a href="delete-admin.php?userId=' . $value['userId'] . '" class="btn btn-danger"
                onclick="return confirmDelete();">Delete</a></td>';
        }

        echo '</tr>';
    }

    // 5a. End the HTML table
    echo '</table>';

    // 6. Disconnect from the database
    $db = null;
}
catch (Exception $e) {
    header('location:error.php');
    exit();
}

require_once 'footer.php';
?>