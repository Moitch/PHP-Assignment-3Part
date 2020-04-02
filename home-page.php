<?php


$pageId = $_GET['pageId'];
require_once 'db.php';

//sql query to select all from pages
$query = "SELECT * FROM pages WHERE pageId = :pageId;";

//prepare and execute
$cmd = $db->prepare($query);
$cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);
$cmd->execute();

//fetch all the data and store in pages
$pages = $cmd->fetch();

$pageName = $pages['pName'];
$content = $pages['content'];

//Change title and loads header

$title = $pageName;

require_once ('header.php');

echo '<h1> '.$pageName.' </h1>';
echo '<br  />';
echo $content;
?>

<?php
require_once 'footer.php';
?>
