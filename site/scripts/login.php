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

$result = "Please login below";

$db = getSqli();
session_start();
$logged_in = "<p> You are not currently signed in. </p>";
if (isset($_SESSION["username"])  ){
    $logged_in = "<p> Signed in as: {$_SESSION["username"]} </p>";

}

if ($_POST) {
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    $username = $_POST["username"];
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
    $loggedIn = false;
    if ($results) {
        $user = mysqli_fetch_array($results);
        if (password_verify($_POST["password"],$user["password"])) {
            $_SESSION['admin'] = true;
            $_SESSION['username'] = $user["username"];
            $result = "You've been succesfully verified.";
            header("Location: /admin/index.php");
            $loggedIn = true;
        }
    }
    if (!$loggedIn) {
        $result = "Couldn't log you in...";
        header("Location: /admin/login.php");
    }
}
