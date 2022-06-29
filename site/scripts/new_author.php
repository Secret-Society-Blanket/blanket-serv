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
// along with this program.  If not, see <https://www.gnu.org/licenses/>.

// See LICENSE in root of repository
require_once __DIR__ . '/utils.php';
checkAdmin();
$command_result = "";
$db = getSqli();
if ($_POST) {
    $edit = NULL;
    $authordb = NULL;
    if (isset($_POST["author_id"])) {
        $edit = (int) $_POST["author_id"];
        $authordb = getSqlRowFromId($db, AUTHOR_TABLE, $_POST["author_id"]);
    }
    $command_result = "Error, something went wrong.";
    $db = getSqli();
    $prep; if ($edit) {$prep = mysqli_prepare(
        $db,
        "UPDATE {$AUTHOR_TABLE} SET name = ?, japanese_name = ?, twitter = ?, pixiv = ?, is_nsfw = ?, description = ?, avatar_link = ? WHERE id = {$edit}");
    } else {
        $prep = mysqli_prepare(
            $db,
            "INSERT INTO {$AUTHOR_TABLE} (name, japanese_name, twitter, pixiv, is_nsfw, description, avatar_link)
                                VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
    }
    mysqli_stmt_bind_param($prep, 'ssssiss', $author, $j_name, $twitter, $pixiv, $nsfw, $desc, $alink);
    $author = $_POST["author-name"];
    $j_name = $_POST["japanese_name"];
    $twitter = $_POST["twitter"];
    $pixiv = $_POST["pixiv"];
    $nsfw = (int) isset($_POST["is-nsfw"]);
    $desc = $_POST["description"];
    $fileExists = ( $_FILES['image']['error'] == 0 );
    if ($authordb && !$fileExists) {
        $alink = $authordb['avatar_link'];
    } else if ($fileExists) {
        $alink = saveFile($_FILES['image']);
    }
    $res = mysqli_stmt_execute($prep);
    if ($res) {
        $command_result = "Complete!";
    }
}

$author = NULL;
$getId = NULL;
$hidden = NULL;
$getAuthorName = NULL;
$getAuthorJapaneseName = NULL;
$getTwitter = NULL;
$getPixiv = NULL;
$getDesc = NULL;
$getNsfw = NULL;
$getNsfwString = NULL;
if ($_GET) {
    $hidden = "";
    if (isset($_GET["author_id"])) {
        $author = getSqlRowFromId($db, AUTHOR_TABLE, $_GET["author_id"]);
        $getId = $author['id'];
        $hidden = "<input type='hidden' id='author_id' name='author_id' value='$getId'>";
        $getAuthorName = $author["name"];
        $getAuthorJapaneseName = $author["japanese_name"];
        $getTwitter = $author["twitter"];
        $getPixiv = $author["pixiv"];
        $getDesc = $author["description"];
        $getNsfw = $author["is_nsfw"];
        if ($getNsfw) {
            $getNsfwString = "checked";
        }
    }
}

$authoroption = "";
$results = mysqli_query($db, "SELECT * FROM $AUTHOR_TABLE");
while ($author = mysqli_fetch_array($results)) {
    $authoroption = $authoroption . "<option value='{$author['id']}' ";
    if ((isset($_['author_id'])) && $_GET['author_id'] == $author['id']) {
        echo ("selected='selected'");
    }
    $authoroption = $authoroption . '>';
    $authoroption = $authoroption . $author['name'];
    $authoroption = $authoroption . "</option>";
}
