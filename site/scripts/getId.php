<?php

require_once __DIR__ . '/utils.php';

$db = getSqli();
if ($_GET) {
    $table = NULL;
    $id = NULL;

    header('Content-Type: text/json');
    if (isset($_GET['manga-id'])) {
        $id = $_GET['manga-id'];
        $table = $MANGA_TABLE;
    }
    else if (isset($_GET['author-id'])) {
        $id = $_GET['author-id'];
        $table = $AUTHOR_TABLE;
    }
    else if (isset($_GET['chapter-id'])) {
        $id = $_GET['chapter-id'];
        $table = $CHAPTER_TABLE;
    }
    $row = getSqlRowFromId($db, $table, $id);
    echo(json_encode($row));
}
