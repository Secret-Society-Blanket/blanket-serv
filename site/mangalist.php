<?php include __DIR__ . '/scripts/list_manga.php';
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/tw-snippets-min.css">
    <link rel="stylesheet" href="style/ssb-min.css">
    <script src="https://unpkg.com/swup@latest/dist/swup.min.js"></script>
    <script defer src="js/swup.js"></script>
    <script src="js/rainbowify.js"></script>
    <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="img/favicon-ios.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32.png" />
    <link rel="icon" type="image/png" sizes="180x180" href="img/favicon-ios.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="img/favicon-android.png" />
    <link rel="icon" type="image/png" sizes="512x512" href="img/favicon-android-splash.png" />

    <style>
    html,
    body,
    div#swup {
        overflow: hidden;
        position: relative;
        height: 100%;
    }
    </style>
    <title> Manga List</title>
    <link rel="stylesheet" type="text/css" href="/style/main.css" />
</head>

<body class="ssb-bg">
    <div id="swup" class="transition-slide">
        <div class="main-cont antialiased">
            <div class="center-cont">
                <table>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Original Title</th>
                        <th>Author</th>
                        <th>Description</th>
                        <th>Number Chapters</th>
                    </tr>
                    <?php

        $mangas = (getSqlRows($db, $MANGA_TABLE));

        while ($manga = mysqli_fetch_array($mangas)) {
            $author = getSqlRowFromId($db, $AUTHOR_TABLE, $manga['author_id']);
        ?>
                    <tr>
                        <td> <img class="cover-list" src=content/<?= $manga['image_link'] ?>></img> </td>
                        <td> <a href="manga.php?manga_id=<?= $manga['id'] ?>"> <?= $manga['title'] ?> <a /> </td>
                        <td> <?= $manga['original_title'] ?> </td>
                        <td> <a href="author.php?author_id=<?= $author['id'] ?>"> <?= $author['name'] ?> </a></td>
                        <td> <?= $manga['description'] ?> </td>
                        <td> <?= $manga['num_chapters'] ?> </td>
                    </tr>
                    <?php
        }
        ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>