<?php
$title = 'Confirm Delete';
require_once ('header.php');

// make this page private
require_once 'auth.php';


$userId = null;
$password = null;
// get userId from url
$userId = $_GET['userId'];

// connect
require_once 'db.php';

// fetch the selected artist
$sql = "SELECT * FROM users WHERE userId = :userId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
$cmd->execute();

// use fetch to select a single record
$user = $cmd->fetch();

$password = $user['password'];

// disconnect
$db = null;

?>

    <h1>Delete User</h1>
    <form method="post" action="delete-admin.php?userId=<?php echo $userId; ?>">
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
            <button class="btn btn-primary offset-sm-2"> Delete</button>
        </div>
    </form>
<?php
require_once 'footer.php';
?>