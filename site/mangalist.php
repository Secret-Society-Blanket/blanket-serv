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
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
            <div id="fade-enabled" class="center-cont ssb-font fade">
                <div class="card-list">
                    <?php

                    $mangas = mysqli_fetch_all(getSqlRows($db, $MANGA_TABLE), MYSQLI_BOTH);
                    usort($mangas, function ($one, $two) { return comparebyDate($one, $two); });
                    $mangas = array_reverse($mangas);

                    foreach ($mangas as $manga) {
                        $author = getSqlRowFromId($db, $AUTHOR_TABLE, $manga['author_id']);
                        $num = $manga['num_chapters'] . " chapters";
                        if ($manga['is_oneshot']) {
                            $num = "Oneshot";
                        }
                        
                        $date = end(get_order_chapters($manga['id']))['release_date'];

                    ?>
                    <div class="fc b-r card glass">
                        <a href="/manga.php?manga_id=<?= $manga['id'] ?>"><img class="card-image transition" data-swup-transition="left" style="background: white;" src=content/<?= $manga['image_link'] ?>></img></a>
                        <a style="font-size: 30px; line-height: 0.8em; margin-bottom: 5px;" href="/manga.php?manga_id=<?= $manga['id'] ?>" data-swup-transition="left" class="transition"> <?= $manga['title'] ?><a />
                            <a style="font-size: 20px; text-decoration: underline; margin-bottom: 5px;" href="/author.php?author_id=<?= $author['id'] ?>" data-swup-transition="left" class="transition"> By&nbsp;<?= $author['name'] ?></a>
                            <p>Last updated <?=$date?></p>
                            <p><?= $num ?></p>
                            <p class="mini-disc"><?= $manga['description'] ?></p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="arrow arrow-up" id="arrow-up"><span class="rainbow">△</span></div>
            <div class="arrow arrow-down" id="arrow-down"><span class="rainbow">▽</span></div>
        </div>
        <div class="footer-main antialiased">
            <div class="footer-content">
                <ul id="breadcrumb" class="breadcrumb ssb-font" style="padding: 0.2em;">
                    <li><a data-swup-transition="right" href="/index.html">Home</a></li>
                    <li><a>Manga List</a></li>
                </ul>
            </div>
        </div>
    </div>
    <script defer src="js/scroll-arrow-min.js"></script>
</body>

</html>