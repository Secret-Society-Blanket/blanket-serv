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

require_once __DIR__ . '/vendor/autoload.php';

use Yosymfony\Toml\Toml;

// Constants and things 
const MANGA_TABLE = "manga";
const CHAPTER_TABLE = "chapters";
const AUTHOR_TABLE = "authors";

// Made for easier string insertion
$MANGA_TABLE = MANGA_TABLE;
$CHAPTER_TABLE = CHAPTER_TABLE;
$AUTHOR_TABLE = AUTHOR_TABLE;

const CONFIG_LOCATION = "/var/blanketserv/conf.toml";

// Returns the Config file as an array.
function getConfig()
{
    $config_file = file_get_contents(CONFIG_LOCATION);
    $array = Toml::Parse($config_file);
    
    return $array;
}

// Gets all rows form a sql table, use mysqli_fetch_array to increment through them.
function getSqlRows($db, $table)
{

    $stmt = new mysqli_stmt($db, "SELECT * FROM {$table}");
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);

    return ($results);
}

// Returns the first Row from a SQL table matching the given id.
function getSqlRowFromId($db, string $table, int $id)
{
    $query = "SELECT * FROM ${table} WHERE id = ${id}";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);

    return (mysqli_fetch_array($results));
}


// Returns the sqli database object.
function getSqli()
{
    $config = getConfig();

    $db = mysqli_connect($config['database']['hostname'], $config['database']['username'], $config['database']['password'], $config['database']['name']);
    return $db;
}
// Gets the full path to all content.
function getContentPath()
{
    $config = getConfig();

    if ($config['storage']['path'][0] == "/") {
        return $config['storage']['path'];
    } else {
        return "/var/www/html/" . $config['storage']['path'];
    }
}

// Saves a file automatically, and returns the new name.
function saveFile($file)
{
    $config = getConfig();
    $target_path = NULL;

    // If the path we have in the config is an absolute path, don't add the cwd.

    $target_path = getContentPath();

    log($target_path);
    $name = $file['name'];
    while (file_exists($target_path . $name)) {
        $name = "new." . $name;
    }

    if (!is_dir($target_path)) {
        mkdir($target_path);
    }

    $target_path = $target_path . $name;


    move_uploaded_file($file['tmp_name'], $target_path);
    return $name;
}


// Saves a chapter, unzipping it at the same time. Returns the directory in content/
function saveChapter($file)
{

    $target_path = getContentPath();
    $zippath = saveFile($file);
    $zip = new ZipArchive;
    $res = $zip->open($target_path . $zippath);

    $filename = basename($zippath);
    $dirname = substr($filename, 0, strrpos($filename, "."));
    if ($res === TRUE) {
        $zip->extractTo($target_path . $dirname);
        $zip->close();
        unlink($target_path . $zippath);
    } else {
        echo ('We fucked up...');
    }

    return $dirname;
}


// Gets all chapters from a given manga id, properly in order.
function get_order_chapters($manga_id)
{
    $db = getSqli();
    $chapters = mysqli_query($db, "SELECT * FROM ".CHAPTER_TABLE." where manga_id = {$manga_id}");
    $ordered = array();
    $unordered = array();
    $order = array();
    while ($chapter = mysqli_fetch_array($chapters)) {
        array_push($unordered, $chapter);
        array_push($order, $chapter['number']);
    }
    $i = 0;
    foreach ($order as $num) {
        $ordered[$num] = $unordered[$i];
        $i++;
    }
    return $ordered;
}

// Get all the pages from a chapter as an array.
function get_pages($chapter_id)
{
    $pages = array();
    $db = getSqli();
    $config = getConfig();
    $content_directory = $config['storage']['path'];
    $chapter = getSqlRowFromId($db, CHAPTER_TABLE, $chapter_id);
    $d = dir("{$content_directory}{$chapter['path']}");
    while (($file = $d->read()) !== false) {
        if (!($file[0] == '.')) {
            array_push($pages, $content_directory . $chapter['path'] . '/' . $file);
        }
    }
    return $pages;
}

// Checks if the user is an admin, if not sends them to the login. Use this on
// every page that only admins should access.
function checkAdmin()
{
    session_start();
    if (!$_SESSION["admin"]) {
        header("Location: /admin/login.php");
    }
}
