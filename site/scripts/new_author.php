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
if ($_POST) {
    $command_result = "Error, something went wrong.";
    $db = getSqli();
    $prep = mysqli_prepare(
        $db,
        "INSERT INTO {$AUTHOR_TABLE} (name, japanese_name, twitter, pixiv, is_nsfw, description, avatar_link)
                            VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    mysqli_stmt_bind_param($prep, 'ssssiss', $author, $j_name, $twitter, $pixiv, $nsfw, $desc, $alink);
    $author = $_POST["author-name"];
    $j_name = $_POST["japanese_name"];
    $twitter = $_POST["twitter"];
    $pixiv = $_POST["pixiv"];
    $nsfw = ($_POST["is-nsfw"] == "nsfw");
    $desc = $_POST["description"];
    $alink = saveFile($_FILES['image']);
    $res = mysqli_stmt_execute($prep);
    if ($res) {
        $command_result = "Complete!";
    }
}
