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

$config = getConfig();
$db = getSqli();
checkAdmin();

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

function newChapter($req)
{
    $config = getConfig();
    $db = getSqli();
    checkAdmin();
    $MANGA_TABLE = MANGA_TABLE;
    $CHAPTER_TABLE = CHAPTER_TABLE;

    $command_result = "Something went wrong...";
    $manga = getSqlRowFromId($db, MANGA_TABLE, $req['manga-id']);
    $insert_c_q = "INSERT INTO {$CHAPTER_TABLE} (manga_id, path, number, title, release_date , credits, local, twitter, dynasty, mangadex) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $prep = mysqli_prepare(
        $db,
        $insert_c_q
    );
    if (!$prep) {
        return "Couldn't create request $insert_c_q";
    }
    mysqli_stmt_bind_param($prep, 'isdsssisss', $mangaid, $path, $number, $title, $releasedate, $credits, $local, $twitter, $dynasty, $mangadex);
    if ($manga == NULL) {
        $command_result = 'No Manga Found';
        return $command_result;
    }
    $mangaid = $req['manga-id'];
    $mangaid = $req['manga-id'];
    $path = saveChapter($_FILES['file']);
    $local = false;
    if ($path == NULL && !$req['external-only']) {
        $command_result = "Please upload a zip file!";
        return $command_result;
    }
    else if ($req['external-only']) {
        $path = "!!external-only!!";
        $local = true;
    }
    if ($req["release-date"]) {
        $releasedate = $req["release-date"];
    } else {
        $cdate = new DateTime();
        $releasedate = $cdate->format("Y-m-d H:i:s");
    }
    $credits = $req['credits'];
    $number = $req['number'];
    $twitter = $req['twitter-link'];
    $dynasty = $req['dynasty-link'];
    $mangadex = $req['mangadex-link'];
    $title = $req['chapter-title'];
    if ($title == "") {
        $title = $manga['title'] . "-" . $number;
    }

    if (!$manga['is_oneshot']) {
        $insert_m_q = "UPDATE {$MANGA_TABLE} SET num_chapters = ? WHERE id = ?";
        $prepm = mysqli_prepare(
            $db,
            $insert_m_q
        );
        mysqli_stmt_bind_param($prepm, 'ii', $m_num, $m_id);
        $m_num = $number;
        $m_id = $mangaid;
        mysqli_stmt_execute($prepm);
    }

    if (mysqli_stmt_execute($prep)) {
        $command_result = 'Complete!';
        return $command_result;
    }
    return "Failed to execute mysql command, maybe the server is down?";
}

$command_result = "";
if ($_POST) {
    $command_result = newChapter($_POST);
}
