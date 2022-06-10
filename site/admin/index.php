<?php
require_once __DIR__ . '/../scripts/utils.php';
checkAdmin();
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/normalize.css">
    <link rel="stylesheet" href="../style/tw-snippets-min.css">
    <link rel="stylesheet" href="../style/ssb-min.css">
    <script src="https://unpkg.com/swup@latest/dist/swup.min.js"></script>
    <script defer src="../js/swup.js"></script>
    <script src="../js/rainbowify.js"></script>
    <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="../img/favicon-ios.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32.png" />
    <link rel="icon" type="image/png" sizes="180x180" href="../img/favicon-ios.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="../img/favicon-android.png" />
    <link rel="icon" type="image/png" sizes="512x512" href="../img/favicon-android-splash.png" />

    <style>
    html,
    body,
    div#swup {
        overflow: hidden;
        position: relative;
        height: 100%;
    }
    </style>
    <title>Admin Index</title>
</head>

<body class="ssb-bg">
    <div id="swup" class="transition-slide">
        <div class="main-cont antialiased">
            <div class="center-cont">
                <p style="font-size: 30px; padding-bottom: 1em;" class="ssb-font"><span class="rainbow">Admin panel</span></p>
                <div style="display: flex; flex-direction: column; gap: 0.5rem; align-items: center;">
                    <a class="ssb-butt ssb-butt-sm ssb-g transition" href="author.php" data-swup-transition="left">Add/Edit an Author</a>
                    <a class="ssb-butt ssb-butt-sm ssb-tq transition" href="manga.php" data-swup-transition="left">Add/Edit Manga</a>
                    <a class="ssb-butt ssb-butt-sm ssb-lb transition" href="chapter.php" data-swup-transition="left">Add/Edit Chapters</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
