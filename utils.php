<?php

require __DIR__ . '/vendor/autoload.php';

use Yosymfony\Toml\Toml;

// Constants and things 
$MANGA_TABLE = "manga";
$CHAPTER_TABLE = "chapters";
$AUTHOR_TABLE = "authors";

function getConfig()
{
    $config_file = file_get_contents("conf.toml");
    $array = Toml::Parse($config_file);

    return $array;
}

function getSqlRows($db, $table)
{

    $stmt = new mysqli_stmt($db, "SELECT * FROM ${table}");
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);

    return ($results);
}

function getSqlRowFromId($db, string $table, int $id)
{
    $query = "SELECT * FROM ${table} WHERE id = ${id}";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);

    return(mysqli_fetch_array($results));
}


function getSqli()
{
    $config = getConfig();

    $db = mysqli_connect($config['database']['hostname'], $config['database']['username'], $config['database']['password'], $config['database']['name']);
    return $db;
}

function saveFile($file)
{
    $config = getConfig();
    $target_path = getcwd() . "/" . $config['storage']['path'] . $file['name'];;
    move_uploaded_file($file['tmp_name'], $target_path);
    return $file['name'];
}
