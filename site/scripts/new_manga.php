<?php
require_once __DIR__ . '/utils.php';

$config = getConfig();
$db = getSqli();
if ($_POST) {
    // If this is set, we're updating a manga, not creating a new one.
    if (isset($_POST["manga-id"])) {
        $update_q = "UPDATE {$MANGA_TABLE} SET title = ?, original_title = ?, author_id = ? , description = ?, image_link = ?, num_chapters = ?, is_oneshot = ? WHERE id = ?";

        $prep = mysqli_prepare(
            $db,
            $update_q
        );

        mysqli_stmt_bind_param(
            $prep,
            'ssissiii',
            $title,
            $ogtitle,
            $authorid,
            $description,
            $imageLink,
            $chaps,
            $mangaid,
            $oneShot
        );
        $title = $_POST["manga-title"];
        $ogtitle = $_POST["manga-original-title"];
        $authorid = $_POST["authors"];
        $description = $_POST["description"];
        if (isset($_FILES['image'])) {
            $imageLink = saveFile($_FILES['image']);
        }
        $mangaid = $_POST["manga-id"];
        $oneShot = (int) isset($_POST["is-oneshot"]);
        getSqlRowFromId($db, $MANGA_TABLE, $_POST["manga-id"]);

        mysqli_stmt_execute($prep);
    } else {
        $insert_q = "INSERT INTO {$MANGA_TABLE} (title, original_title, author_id, description, image_link, num_chapters, is_oneshot) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $prep = mysqli_prepare(
            $db,
            $insert_q
        );
        mysqli_stmt_bind_param($prep, 'ssissii', $title, $ogtitle, $authorid, $description, $imageLink, $chaps, $isOneshot);
        $title = $_POST["manga-title"];
        $ogtitle = $_POST["manga-original-title"];
        $authorid = $_POST["authors"];
        $description = $_POST["description"];
        $imageLink = saveFile($_FILES['image']);
        $isOneshot = (int) isset($_POST["is-oneshot"]);
        $chaps = 0;
        mysqli_stmt_execute($prep);
    }
}
$hidden = "";
if (isset($_GET["manga-id"])) {
    $hidden = '<input type="hidden" id="manga-id" name="manga-id" value="{$_GET["manga-id"]}">';
    $manga = getSqlRowFromId($db, $MANGA_TABLE, $_GET["manga-id"]);
    $getTitle = $manga["title"];
    $getAuthor = $manga["author_id"];
    $getOriginalTitle = $manga["original_title"];
    $getDescription = $manga["description"];
    $getImageLink = $manga["image_link"];
    $isOneShot = $manga["is_oneshot"];
} else {
    $getTitle = NULL;
    $getAuthor = NULL;
    $getOriginalTitle = NULL;
    $getDescription = NULL;
    $getImageLink = NULL;
    $isOneShot = NULL;
}



$results = getSqlRows($db, "authors");
$authors = "";
while ($author = mysqli_fetch_array($results)) {
    $select = NULL;
    if ($author['id'] == $getAuthor) {
        $select = "selected";
    }
    $authors = $authors . "<option value='{$author['id']}' selected='{$select}'>";
    $authors = $authors . $author['name'];
    $authors = $authors . "</option>";
}

$mangas = "";
$results = mysqli_query($db, "SELECT * FROM manga");
while ($manga = mysqli_fetch_array($results)) {
    $mangas = $mangas . "<option value='{$manga['id']}' ";
    if ((isset($_['manga-id'])) && $_GET['manga-id'] == $manga['id']) {
        echo ("selected='selected'");
    }
    $mangas = $mangas . '>';
    $mangas = $mangas . $manga['title'];
    $mangas = $mangas . "</option>";
}
