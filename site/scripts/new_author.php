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
        "INSERT INTO {$AUTHOR_TABLE} (name, links, avatar_link)
                            VALUES (?, ?, ?)"
    );
    mysqli_stmt_bind_param($prep, 'sss', $author, $links, $alink);
    $author = $_POST["author-name"];
    $links = $_POST["social-links"];
    $alink = saveFile($_FILES['image']);
    mysqli_stmt_execute($prep);
    $command_result = "Complete!";
}
