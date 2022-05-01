<?php
require_once __DIR__ . '/utils.php';
$author;
$mangas;
$db = getSqli();
if ($_GET) {
    if (isset($_GET['author_id'])) {
        $author = getSqlRowFromId($db, $AUTHOR_TABLE, $_GET['author_id']);
        $mangas = mysqli_query($db, "SELECT * FROM $MANGA_TABLE where author_id = {$author['id']}");
    }
}
