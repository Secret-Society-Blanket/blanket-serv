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
