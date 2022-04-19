<?php


require __DIR__ . '/utils.php';

$config = getConfig();
function initDatabase()
{
    $config = getConfig();

    $db = mysqli_connect($config['database']['hostname'], $config['database']['username'], $config['database']['password'], '');

    if (!mysqli_select_db($db, $config['database']['name'])) {
        mysqli_query($db, 'CREATE DATABASE ' . $config['database']['name']);
        mysqli_select_db($db, $config['database']['name']);
        echo ("Created database " . $config['database']['name'] . "<br>");
    }

    echo ("Loaded database " . $config['database']['name'] . "<br>");

    if (!mysqli_query($db, 'DESCRIBE manga')) {
        $results = mysqli_query($db, 'CREATE TABLE manga (id MEDIUMINT AUTO_INCREMENT, title TEXT, original_title TEXT, author_id INT, description TEXT, image_link TEXT, num_chapters INT, PRIMARY KEY (id))');
        print_r($results);
        echo ("Created table manga.<br>");
    }
    if (!mysqli_query($db, 'DESCRIBE authors')) {
        mysqli_query($db, 'CREATE TABLE authors (id MEDIUMINT AUTO_INCREMENT, name TEXT, links TEXT, avatar_link TEXT, PRIMARY KEY (id))');
        echo ("Created table authors.<br>");
    }
    if (!mysqli_query($db, 'DESCRIBE chapters')) {
        mysqli_query(
            $db,
            'CREATE TABLE chapters (
                id MEDIUMINT NOT NULL AUTO_INCREMENT,
                manga_id INT,
                author_id INT ,
                path TEXT,
                number INT,
                release_date DATE,
                credits TEXT,
                PRIMARY KEY (id))'
        );
        echo ("Created table chapters<br>");
    }
    mysqli_query($db, 'FLUSH TABLES');
    return $db;
}

initDatabase();
mkdir($config['storage']['path']);
?>
