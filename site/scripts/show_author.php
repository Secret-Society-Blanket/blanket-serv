<?php
require_once __DIR__ . '/utils.php';
$author;
$mangas;
$db = getSqli();
if ($_GET) {
    if (isset($_GET['id']) or isset($_GET['author_id'])) {
        if (!isset($_GET['id'])) {
            $_GET['id'] = $_GET['author_id'];
        }

        $author = getSqlRowFromId($db, $AUTHOR_TABLE, $_GET['id']);
        $mangas = mysqli_query($db, "SELECT * FROM $MANGA_TABLE where author_id = {$author['id']}");
    }
}
