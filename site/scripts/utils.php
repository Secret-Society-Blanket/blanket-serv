<?php

require_once __DIR__ . '/vendor/autoload.php';

use Yosymfony\Toml\Toml;

// Constants and things 

$MANGA_TABLE = "manga";
$CHAPTER_TABLE = "chapters";
$AUTHOR_TABLE = "authors";

function getConfig()
{
    $config_file = file_get_contents(__DIR__ . "/conf.toml");
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

    return (mysqli_fetch_array($results));
}


function getSqli()
{
    $config = getConfig();

    $db = mysqli_connect($config['database']['hostname'], $config['database']['username'], $config['database']['password'], $config['database']['name']);
    return $db;
}
function getContentPath() {
    $config = getConfig();

    if ($config['storage']['path'][0] == "/") {
        return $config['storage']['path'];
    } else {
        return "/var/www/html/" . $config['storage']['path'];
    }
}

function saveFile($file)
{
    $config = getConfig();
    $target_path = NULL;

    // If the path we have in the config is an absolute path, don't add the cwd.

    $target_path = getContentPath();

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


function saveChapter($file)
{

    $target_path = getContentPath();
    $zippath = saveFile($file);
    $zip = new ZipArchive;
    $res = $zip->open($target_path . $zippath);

    $filename = basename($zippath);
    $dirname = substr($filename, 0, strrpos($filename, "."));
    if ($res === TRUE) {
        $zip->extractTo($target_path . $dirname );
        $zip->close();
        unlink($target_path . $zippath);
    }
    else {
        echo ('We fucked up...');
    }

    return $dirname;
}
