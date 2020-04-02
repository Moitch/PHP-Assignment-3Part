<?php
$title = 'Editing User';
require_once ('header.php');

// make this page private
require_once 'auth.php';

// initialize variables for each field
$pageId = null;
$pName = null;
$content = null;

$pageId = $_GET['pageId'];

// connect
require_once 'db.php';

// fetch the selected page
$sql = "SELECT * FROM pages WHERE pageId = :pageId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);
$cmd->execute();

// use fetch to select a single record
$user = $cmd->fetch();

$pName = $user['pName'];
$content = $user['content'];


// disconnect
$db = null;

?>

    <h1>Edit User</h1>
    <main class="container">
        <h1>Page Creation</h1>
        <form method="post" action="save-page-edit.php?pageId=<?php echo $pageId; ?>">
            <fieldset class="form-group">
                <label for="pName" class="col-md-2">Page Title:</label>
                <input name="pName" id="pName" required value="<?php echo $pName; ?>"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="content" class="col-md-2">Content:</label>
                <textarea name="content" id="content" required maxlength="255" style="width: 800px"><?php echo $content; ?></textarea>
            </fieldset>
            <div class="offset-md-2">
                <input type="submit" value="Save Page" class="btn btn-info"/>
            </div>
        </form>
    </main>
<?php
require_once 'footer.php';
?>