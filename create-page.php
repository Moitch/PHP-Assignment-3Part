<!--LOAD HEADER and change title-->
<?php
$title = 'Create Page';
require_once ('header.php');
?>
<main class="container">
    <h1>Page Creation</h1>
    <form method="post" action="save-page.php">
        <fieldset class="form-group">
            <label for="pName" class="col-md-2">Page Title:</label>
            <input name="pName" id="pName" required/>
        </fieldset>
        <fieldset class="form-group">
            <label for="content" class="col-md-2">Content:</label>
            <textarea name="content" id="content" required maxlength="255" style="width: 800px">Enter Content</textarea>
        </fieldset>
        <div class="offset-md-2">
            <input type="submit" value="Create Page" class="btn btn-info"/>
        </div>
    </form>
</main>
<!--LOAD FOOTER-->
<?php
require_once 'footer.php';
?>

