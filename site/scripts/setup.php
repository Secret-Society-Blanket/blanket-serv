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


const CHAPTER_TABLE_SCHEMA = "CREATE TABLE " . CHAPTER_TABLE . " (" .
    " id MEDIUMINT NOT NULL AUTO_INCREMENT," .
    " manga_id INT," .
    " title TEXT," .
    " path TEXT," .
    " number DOUBLE NOT NULL," .
    " release_date DATE," .
    " local BOOLEAN," .
    " twitter TEXT," .
    " dynasty TEXT," .
    " mangadex TEXT," .
    " credits TEXT," .
    " PRIMARY KEY (id))";
const AUTHOR_TABLE_SCHEMA = "CREATE TABLE . " . AUTHOR_TABLE . " (" .
    " id MEDIUMINT AUTO_INCREMENT," .
    " name TEXT," .
    " japanese_name TEXT," .
    " twitter TEXT," .
    " pixiv TEXT," .
    " description TEXT," .
    "is_nsfw BOOLEAN," .
    " avatar_link TEXT," .
    " PRIMARY KEY (id))";
const MANGA_TABLE_SCHEMA = "CREATE TABLE " . MANGA_TABLE . " (" .
    " id MEDIUMINT AUTO_INCREMENT," .
    " title TEXT," .
    " original_title TEXT," .
    " author_id INT," .
    " description TEXT," .
    " image_link TEXT," .
    " num_chapters INT," .
    " is_oneshot BOOLEAN," .
    " PRIMARY KEY (id))";

function initDatabase($reset)
{

    $config = getConfig();
    $out = "";

    $db = mysqli_connect($config['database']['hostname'], $config['database']['username'], $config['database']['password'], '');
    if ($reset == "Yes") {
        checkAdmin();
        mysqli_query($db, 'DROP DATABASE ' . $config['database']['name']);
        $out .= "Reset databse<br>";
    }
    mysqli_query($db, 'DROP DATABASE template_db');
    if (!mysqli_select_db($db, 'template_db')) {
        mysqli_query($db, 'CREATE DATABASE template_db');
        mysqli_select_db($db, 'template_db');
        mysqli_query($db, MANGA_TABLE_SCHEMA);
        mysqli_query($db, CHAPTER_TABLE_SCHEMA);
        mysqli_query($db, AUTHOR_TABLE_SCHEMA);
    }

    $templatedb = mysqli_connect($config['database']['hostname'], $config['database']['username'], $config['database']['password'], 'template_db');

    if (!mysqli_select_db($db, $config['database']['name'])) {
        mysqli_query($db, 'CREATE DATABASE ' . $config['database']['name']);
        mysqli_select_db($db, $config['database']['name']);
        $out .= ("Created database " . $config['database']['name'] . "<br>");
    } else {
        checkAdmin();

    }

    $out .= ("Loaded database " . $config['database']['name'] . "<br>");
    if (!mysqli_query($db, 'DESCRIBE manga')) {
        $results = mysqli_query($db, MANGA_TABLE_SCHEMA);
        $out .= "Created table manga.<br>";
    } else {
        $out .= matchTableToTemplate($db, $templatedb, MANGA_TABLE) . '<br>';
    }
    if (!mysqli_query($db, 'DESCRIBE authors')) {
        mysqli_query($db, AUTHOR_TABLE_SCHEMA);
        $out .= ("Created table authors.<br>");
    } else {
        $out .= matchTableToTemplate($db, $templatedb, AUTHOR_TABLE) . '<br>';
    }
    if (!mysqli_query($db, 'DESCRIBE chapters')) {
        mysqli_query(
            $db,
            CHAPTER_TABLE_SCHEMA
        );
        $out .= ("Created table chapters<br>");
    } else {
        $out .= matchTableToTemplate($db, $templatedb, CHAPTER_TABLE) . '<br>';
    }

    if (!mysqli_query($db, 'DESCRIBE users')) {
        mysqli_query(
            $db,
            'CREATE TABLE users (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL
            )'
        );
        $out .= ("Created table users<br>");
    }

    mysqli_query($db, 'DROP DATABASE template_db');
    mysqli_query($db, 'FLUSH TABLES');
    return $out;
}

function matchTableToTemplate($db, $templatedb, $tablename)
{

    $out = "";
    $ttarget = mysqli_fetch_all(mysqli_query($db, "DESCRIBE {$tablename}"));
    $ttemplate = mysqli_fetch_all(mysqli_query($templatedb, "DESCRIBE {$tablename}"));
    if ($ttarget == $ttemplate) {
        return "$tablename is correct";
    }
    $num = 0;
    foreach ($ttemplate as $templaterow) {
        $found = false;
        foreach ($ttarget as $targetrow) {
            if ($templaterow[0] == $targetrow[0]) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            $name = $templaterow[0];
            $type = $templaterow[1];
            $cannull = "NOT NULL";
            if ($cannull == "YES") {
                $cannull = "";
            }
            $primary = "";
            if ($templaterow[3] == "PRI") {
                $primary = "PRIMARY KEY";
            }
            $default = "";
            if ($templaterow[4] != "") {
                $default = "DEFAULT " . $templaterow[4];
            }
            $extra = $templaterow[5];

            $position = "FIRST";
            if ($num != 0) {
                $position = "AFTER " . $ttemplate[$num - 1][0];
            }

            $res = mysqli_query($db, "ALTER TABLE $tablename ADD $name $type $cannull $primary $default $extra $position");
            if ($res) {
                $out .= "Successfully added $name to $tablename";
            } else {
                $out .= "Ran into an error while adding $name to $tablename: " . mysqli_error($db);
            }
        }
        $num++;
    }
    if ($out == "") {
        return "$tablename is correct";
    }
    return $out;
}


// Password will be hashed 
function makeInitUser($user, $pass)
{
    $config = getConfig();

    $db = getSqli();
    $res = mysqli_query($db, 'SELECT COUNT(*) FROM users');

    $count = mysqli_fetch_array($res)[0];

    if ($count == 0) {
        $insert_q = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($db, $insert_q);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        $password = password_hash($pass, PASSWORD_BCRYPT);
        $username = $user;
        mysqli_stmt_execute($stmt);
        return "Created $user!";
    }
    return "You've already made an admin account, silly!";
}


if ($_POST) {
    $result = initDatabase($_POST["reset"]);
    $result = $result . makeInitUser($_POST["username"], $_POST["password"]);
}
