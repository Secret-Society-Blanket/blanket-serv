<?php
require_once __DIR__ . '/utils.php';

const RET = "Return to Manga Page";
const NEXTCHAP = "Next Chapter";
const NEXT = "Next";
const PREV = "Prev";

$db = getSqli();
$manga;
$author;
$chapters; $chapter;
$page;
$image_link;
// This will contain the link to the next page.
$next_page_link;
// This will contain the link to the previous page.
$prev_page_link;
$next_page_text;
$prev_page_text;
$prev_chapter_style = "";

if ($_GET) {
  if (isset($_GET['manga_id'])) {

    $next_page_text = NEXT;
    $prev_page_text = PREV;

    $prev_page_style = "pointer-events: None; visibility: hidden;";
  } else {
    $prev_chapter--;
    $prev_pages = get_pages($chapters[$prev_chapter]['id']);
    $prev_page = 0;
    $prev_page_text = "Previous Chapter";
  }

  $manga = getSqlRowFromId($db, $MANGA_TABLE, $_GET['manga_id']);
  $chapters = get_order_chapters($manga['id']);

  // Get the first chapter if none is set.
  if (!isset($_GET['num_chapter'])) {
    $_GET['num_chapter'] = array_key_first($chapters);
  }

  // Get array of all pages of the current chapter.
  $pages = get_pages($chapters[$_GET['num_chapter']]['id']);

  // If no page is set, or the page count is invalid, set it to 0.
  if (!isset($_GET['page']) ||  $_GET['page'] >= count($pages)) {
    $_GET['page'] = 0;
  }

  $image_link = $pages[$_GET['page']];
  $chapter = $chapters[$_GET['num_chapter']];

  $next_page = $_GET['page'] + 1;
  $next_chapter = $_GET['num_chapter'];
  $done_manga = false;
  // If the next page would be in the next chapter
  if ($next_page >= count($pages)) {
    // If the next chapter doesn't exist
    if ($next_chapter == array_key_last($chapters)) {
      $done_manga = true;
      $next_page_text = RET;
    } else {
      $next_chapter++;
      $next_page = 0;
      $next_page_text = NEXTCHAP;
    }
  }

  // Now we generate the links
  if ($done_manga) {
    $next_page_link = "manga.php?manga_id={$manga['id']}";
  } else {
    $next_page_link = "reader.php?manga_id={$manga['id']}&num_chapter={$next_chapter}&page={$next_page}";
  }

  $prev_page = $_GET['page'] - 1;
  $prev_chapter = $_GET['num_chapter'];
  $done_manga = false;

  if ($prev_page < 0) {
    if ($prev_chapter == array_key_first($chapters)) {
      $done_manga = true;
      $prev_page_text = PREV;
      $prev_page_style = "pointer-events: None; visibility: hidden;";
    } else {
      $prev_chapter--;
      $prev_pages = get_pages($chapters[$prev_chapter]['id']);
      $prev_page = count($prev_pages) - 1;
      $prev_page_text = "Previous Chapter";
    }
  }

  if ($done_manga) {
    $prev_page_link = "manga.php?manga_id={$manga['id']}";
  } else {
    $prev_page_link = "reader.php?manga_id={$manga['id']}&num_chapter={$prev_chapter}&page={$prev_page}";
  }
}
}
