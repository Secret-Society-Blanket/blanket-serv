<?php
require_once __DIR__ . '/utils.php';
$manga;
$author;
$chapters;
$db = getSqli();
if ($_GET) {
    if (isset($_GET['manga_id'])) {
        $manga = getSqlRowFromId($db, $MANGA_TABLE, $_GET['manga_id']);
        $author = getSqlRowFromId($db, $MANGA_TABLE, $manga['author_id']);
        $qchapters = mysqli_query($db, "SELECT * FROM $CHAPTER_TABLE where manga_id = {$manga['id']}");
        $chapters = get_order_chapters($manga['id']);
    }
}
