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
    $mangas = $mangas.'>';
    $mangas = $mangas. $manga['title'];
    $mangas = $mangas."</option>";
}

$command_result = "";
if ($_POST) {
    $command_result = "Something went wrong...";
    $manga = getSqlRowFromId($db, $MANGA_TABLE, $_POST['manga-id']);
    $insert_c_q = "INSERT INTO {$CHAPTER_TABLE} (manga_id, path, number, release_date , credits) VALUES (?, ?, ?, ?, ?)";
    $prep = mysqli_prepare($db,
        $insert_c_q
    );
    mysqli_stmt_bind_param($prep, 'isiss', $mangaid, $path, $number, $releasedate, $credits);
    if ($manga == NULL) {
        $command_result = 'No Manga Found';
    } else {
        $mangaid = $_POST['manga-id'];
        $path = saveChapter($_FILES['file']);
        if ($_POST["release-date"] = "") {
            $releasedate = $_POST["release-date"];
        } else {
            $cdate = new DateTime();
            $releasedate = $cdate->format("Y-m-d H:i:s");
        }
        $credits = $_POST['credits'];
        $number = $_POST['number'];

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
        }
    }
}

