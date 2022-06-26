<?php
include __DIR__ . '/scripts/reader.php';
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/tw-snippets-min.css">
    <link rel="stylesheet" href="style/ssb-min.css">
    <script src="https://unpkg.com/swup@latest/dist/swup.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script defer src="js/main.js"></script>
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
    <title>
        <?= $manga['title'] ?>
    </title>
    <link rel="stylesheet" type="text/css" href="/style/reader.css" />
</head>

<body class="ssb-bg">
    <div id="swup" class="transition-slide">
        <div class="main-cont antialiased">
            <div id="fade-enabled" class="center-cont reader ssb-font fade-reader">
                <div id="page-holder">
                    <a data-swup-transition="left" href=/<?= $next_page_link ?>>
                        <img id="page" class="reader-image-width" src='<?= $image_link ?>'></img>
                    </a>
                </div>
                <div class="reader-settings fr">
                    <a data-swup-transition="right" class="ssb-butt ssb-butt-sm ssb-o flip" href=/<?= $prev_page_link ?>>&lt; Prev.</a>
                    <input type="checkbox" id="fit-page" name="fit-page" class="checkbox-fit-page ssb-font">
                    <a data-swup-transition="left" class="ssb-butt ssb-butt-sm ssb-g flip" href=/<?= $next_page_link ?>>Next &gt;</a>
                </div>
            </div>
            <div class="arrow arrow-up" id="arrow-up"><span class="rainbow">△</span></div>
            <div class="arrow arrow-down" id="arrow-down"><span class="rainbow">▽</span></div>
        </div>
        <div class="footer-main antialiased">
            <div class="footer-content">
                <ul id="breadcrumb" class="breadcrumb ssb-font" style="padding: 0.2em;">
                    <li><a data-swup-transition="right" href="/index.html">Home</a></li>
                    <li><a data-swup-transition="right" href="/mangalist.php">Manga List</a></li>
                    <li><a data-swup-transition="right" href="/manga.php?manga_id=<?= $manga['id'] ?>"><?= $manga['title'] ?></a></li>
                    <li><a>1 - Nom the bomb chrom shlom eat the pant</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>