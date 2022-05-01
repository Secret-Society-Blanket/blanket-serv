<?php

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
