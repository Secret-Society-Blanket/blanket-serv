<?php
require_once __DIR__ . '/utils.php';

$db = getSqli();
$manga;
$author;
$chapters;
$chapter;
$page;
$image_link;
// This will contain the link to the next page.
$next_page_link;
// This will contain the link to the previous page.
$prev_page_link;
if ($_GET) {
    if (isset($_GET['manga_id'])) {
        $manga = getSqlRowFromId($db, $MANGA_TABLE, $_GET['manga_id']);
        $chapters = get_order_chapters($manga['id']);
        if (!isset($_GET['num_chapter'])) {
            $_GET['num_chapter'] = array_key_first($chapters);
        }
        $pages = get_pages($chapters[$_GET['num_chapter']]['id']);
        if (!isset($_GET['page']) ||  $_GET['page'] >= count($pages)) {
            $_GET['page'] = 0;
        }
        $image_link = $pages[$_GET['page']];
        $next_page = $_GET['page'] + 1;
        $next_chapter = $_GET['num_chapter'];
        $done_manga = false;
        if ($next_page >= count($pages)) {
            if ($next_chapter == array_key_last($chapters)) {
                $done_manga = true;
            } else {
                $next_chapter++;
                $next_page = 0;
            }
        }

        if (!$done_manga) {
            $next_page_link = "reader.php?manga_id={$manga['id']}&num_chapter={$next_chapter}&page={$next_page}";
        } else {
            $next_page_link = "manga.php?manga_id={$manga['id']}";
        }

        $prev_page = $_GET['page'] - 1;
        $prev_chapter = $_GET['num_chapter'];
        $done_manga = false;
        if ($prev_page < 0) {
            if ($prev_chapter == array_key_first($chapters)) {
                $done_manga = true;
            } else {
                $prev_chapter--;
                $prev_pages = get_pages($chapters[$prev_chapter]['id']);
                $prev_page = count($prev_pages) - 1;
            }
        }

        if (!$done_manga) {
            $prev_page_link = "reader.php?manga_id={$manga['id']}&num_chapter={$prev_chapter}&page={$prev_page}";
        } else {
            $prev_page_link = "manga.php?manga_id={$manga['id']}";
        }
    }
}
