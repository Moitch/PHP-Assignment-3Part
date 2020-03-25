<?php
$title = 'Artist Details';
require_once ('header.php');

// make this page private
require_once 'auth.php';
//if (empty($_SESSION['userId'])) {
//    header('location:login.php');
//    exit();
//}

// initialize variables for each field
$userId = null;
$username = null;
$password = null;

if (!empty($_GET['userId'])) {
    $userId = $_GET['userId'];

    // connect
    require_once 'db.php';

    // fetch the selected artist
    $sql = "SELECT * FROM users WHERE userId = :userId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
    $cmd->execute();

    // use fetch without a loop instead of fetchAll with a loop as we're only selecting a single record
    $user = $cmd->fetch();
    $username = $user['username'];
    $password = $user['password'];


    // disconnect
    $db = null;
}
?>

    <h1>Edit User</h1>
    <form method="post" action="save-user.php">
        <fieldset class="form-group">
            <label for="username" class="col-md-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com"
                   value="<?php echo $username; ?>"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-md-2">Password:</label>
            <input type="password" name="password" id="password" required/>
            <img id="showHideIcon" src="img/show.png" alt="Show/Hide Password" onclick="showHidePassword()" />
        </fieldset>
        <fieldset class="form-group">
            <label for="confirm" class="col-md-2">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required
                   onkeyup="return comparePasswords()"/>
            <span id="pwMsg"></span>
        </fieldset>
        <div class="offset-md-2">
            <input name="userId" id="userId" value="<?php echo $userId; ?>" type="hidden" />
            <button class="btn btn-primary offset-sm-2">Save</button>
        </div>
    </form>
<?php
require_once 'footer.php';
?>