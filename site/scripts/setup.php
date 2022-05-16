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

function initDatabase()
{
    $config = getConfig();
    $out = "";

    $db = mysqli_connect($config['database']['hostname'], $config['database']['username'], $config['database']['password'], '');

    if (!mysqli_select_db($db, $config['database']['name'])) {
        mysqli_query($db, 'CREATE DATABASE ' . $config['database']['name']);
        mysqli_select_db($db, $config['database']['name']);
        $out = $out . ("Created database " . $config['database']['name'] . "<br>");
    }

    $out = $out . ("Loaded database " . $config['database']['name'] . "<br>");
    if (!mysqli_query($db, 'DESCRIBE manga')) {
        $results = mysqli_query($db, 'CREATE TABLE manga (id MEDIUMINT AUTO_INCREMENT, title TEXT, original_title TEXT, author_id INT, description TEXT, image_link TEXT, num_chapters INT, is_oneshot BOOLEAN, PRIMARY KEY (id))');
        print_r($results);
        $out = $out . "Created table manga.<br>";
    }
    if (!mysqli_query($db, 'DESCRIBE authors')) {
        mysqli_query($db, 'CREATE TABLE authors (id MEDIUMINT AUTO_INCREMENT, name TEXT, links TEXT, avatar_link TEXT, PRIMARY KEY (id))');
        $out = $out . ("Created table authors.<br>");
    }
    if (!mysqli_query($db, 'DESCRIBE chapters')) {
        mysqli_query(
            $db,
            'CREATE TABLE chapters (
                id MEDIUMINT NOT NULL AUTO_INCREMENT,
                manga_id INT,
                path TEXT,
                number INT NOT NULL,
                release_date DATE,
                credits TEXT,
                PRIMARY KEY (id))'
        );
        $out = $out . ("Created table chapters<br>");
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
        $out = $out . ("Created table users<br>");
    }
    mysqli_query($db, 'FLUSH TABLES');
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

$result = "";

if ($_POST) {
    $result = initDatabase();
    $result = $result . makeInitUser($_POST["username"], $_POST["password"]);
}
