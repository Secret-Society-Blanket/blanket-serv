<?php
require_once __DIR__ . '/utils.php';

$config = getConfig();
$db = getSqli();

$mangas = "";
$results = mysqli_query($db, "SELECT * FROM manga");
while ($manga = mysqli_fetch_array($results)) {
    $mangas = $mangas . "<option value='{$manga['id']}' ";
    if ((isset($_['manga-id'])) && $_GET['manga-id'] == $manga['id']) {
        echo ("selected='selected'");
    }
    $mangas = $mangas.'>';
    $mangas = $mangas. $manga['title'];
    $mangas = $mangas."</option>";
}

?>
