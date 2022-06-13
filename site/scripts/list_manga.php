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

// Takes two manga arrays and compares their latest chapter's release dates.
function compareByDate($one, $two) {
    $lastChapDateOne = getLatestChapterDate($one);
    $lastChapDateTwo = getLatestChapterDate($two);
    return $lastChapDateOne->getTimestamp() -  $lastChapDateTwo->getTimestamp;
}


function getLatestChapterDate($manga) {

    if ($manga == NULL ) {
        return NULL;
    }
    $manga_id = $manga['id'];
    $db = getSqli();
    $chapter = end(mysqli_fetch_all(mysqli_query($db, "SELECT * FROM ".CHAPTER_TABLE." where manga_id = {$manga_id}"), MYSQLI_ASSOC));
    return new DateTime($chapter['release_date']);
}

function orderMangaByDate($mangas) {
    $unordered = $mangas;
    $ordered = array();

    while (sizeof($unordered) != 0) {

        $oldest = NULL;
        $i = 0;
        foreach ($unordered as $manga) {
            $lastdate = NULL;
            $date = getLatestChapterDate($manga);
            print_r ($date );
            if ($oldest != NULL) {
                $lastdate = getLatestChapterDate($mangas[$oldest]);
            }
            if ($oldest == NULL || $date < $lastdate) {
                $oldest = $i;
            }
            $i++;
        }
        $ordered[] = $unordered[$oldest];

        unset($unordered[$oldest]);
    }
    return $ordered;
}
