<?php
require_once __DIR__ . '/utils.php';
$manga;
$author;
$chapters;
$db = getSqli();

function buildMangaUrl($mangaId, $chapterNumber) {
    $out ="reader.php?manga_id=$mangaId&num_chapter=$chapterNumber";
    return $out;
}

if ($_GET) {
    if (isset($_GET['manga_id'])) {
        $manga = getSqlRowFromId($db, $MANGA_TABLE, $_GET['manga_id']);
        $author = getSqlRowFromId($db, $MANGA_TABLE, $manga['author_id']);
        $chapters = get_order_chapters($manga['id']);
        $lastChapter = end($chapters);
    }
} else {
    header("/mangalist.php");
}
