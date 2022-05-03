<?php
include __DIR__ . '/scripts/reader.php';
?>

<html>

<head>
    <title>
        <?= $manga['title'] ?>
    </title>
    <link rel="stylesheet" type="text/css" href="/style/reader.css" />
</head>

<body>
    <h1>
        <?= $manga['title'] ?>
    </h1>

    <a href=<?= $prev_page_link ?>> Previous </a>
    <a href=<?= $next_page_link ?>> Next </a>
    <div class='page'>
        <a href=<?= $next_page_link ?>>
            <img src='<?= $image_link ?>'></img>
        </a>
    </div>
    <a href=<?= $prev_page_link ?>> Previous </a>
    <a href=<?= $next_page_link ?>> Next </a>
</body>

</html>
