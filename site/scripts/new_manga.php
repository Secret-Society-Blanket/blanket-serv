<?php
// Blanket-Serv: A Manga Server
// Copyright (C) 2022 skyenet
// Blanket-Serv: A Manga Server

// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <https://www.gnu.org/licenses/>. // See LICENSE in root of repository
require_once __DIR__ . '/utils.php';

session_start();
$config = getConfig();
$db = getSqli();
checkAdmin();
$command_result = "";
if ($_POST) {
    $command_result = "Couldn't successfully complete request.";
    // If this is set, we're updating a manga, not creating a new one.
    if (isset($_POST["manga-id"])) {
        $update_q = "UPDATE {$MANGA_TABLE} SET title = ?, original_title = ?, author_id = ? , description = ?, image_link = ?, num_chapters = ?, is_oneshot = ? WHERE id = ?";

        $manga = getSqlRowFromId($db, MANGA_TABLE, (int) $_POST["manga-id"]);
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
            $oneShot,
            $mangaid
        );
        $title = $_POST["manga-title"];
        $ogtitle = $_POST["manga-original-title"];
        $authorid = $_POST["authors"];
        $description = $_POST["description"];
        $fileExists = ( $_FILES['image']['error'] == 0 );
        if ($fileExists) {
            $imageLink = saveFile($_FILES['image']);
        }
        else {
            $imageLink = $manga['image_link'];
        }
        $oneShot = (int) isset($_POST["is-oneshot"]);
        $mangaid = (int) $_POST["manga-id"];

        $res = mysqli_stmt_execute($prep);
        if ($res) {
            $command_result = "Complete!";
        }
        else {
            $command_result = "There was an error... </br>". mysqli_error($db);
        }
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
        $fileExists = ( $_FILES['image']['error'] == 0 );
        if ($fileExists) {
            $imageLink = saveFile($_FILES['image']);
        } else {
            $imageLink = "";
        }

        $isOneshot = (int) isset($_POST["is-oneshot"]);
        $chaps = 0;
        $res = mysqli_stmt_execute($prep);
        if (res) {
            $command_result = "Complete!";
        }
        else {
            $command_result = "There was an error... </br>". mysqli_error($db);
        }
    }
}
$hidden = "";
$getAuthor;
$getTitle;
$getOriginalTitle;
$getImageLink;
$isOneshot;
$getDescription;
if (isset($_GET["manga-id"])) {
    $manga = getSqlRowFromId($db, $MANGA_TABLE, $_GET["manga-id"]);
    $id = $manga['id'];
    $hidden = '<input type="hidden" id="manga-id" name="manga-id" value='.$id.'>';
    $getTitle = $manga["title"];
    $getAuthor = (int) $manga["author_id"];
    $getOriginalTitle = $manga["original_title"];
    $getDescription = $manga["description"];
    $getImageLink = $manga["image_link"];
    $isOneshot = $manga["is_oneshot"];
} else {
    $getTitle = NULL;
    $getAuthor = NULL;
    $getOriginalTitle = NULL;
    $getDescription = "";
    $getImageLink = NULL;
    $isOneshot = false;
}



$results = getSqlRows($db, "authors");
$authors = "";
$select = NULL;
while ($author = mysqli_fetch_array($results)) {
    if ($author['id'] == $getAuthor) {
        $select = "selected";
    }
    $authors = $authors . "<option value='{$author['id']}' selected='{$select}'>";
    $authors = $authors . $author['name'];
    $authors = $authors . "</option>";
}
if (!$select) {
    $select = "selected='selected'";
}
else {
    $select = "";
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
