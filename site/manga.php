<?php
include __DIR__ . '/scripts/show_manga.php';
?> <html>

<head>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style/normalize.css">
        <link rel="stylesheet" href="style/tw-snippets.css">
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
        <title><?= $manga['title'] ?></title>
        <link rel="stylesheet" type="text/css" href="/style/main.css" />
    </head>

<body>

    <body class="ssb-bg">
        <div id="swup" class="transition-slide">
            <div class="main-cont antialiased">
                <div class="center-cont ssb-font">
                    <div class="manga-main glass">
                        <img class="manga-cover" src="content/<?= $manga['image_link'] ?>"></img>
                        <div class="manga-sub">
                            <p style="text-align: left;"><span class="title-en" style="display: inline-block;"><?= $manga['title'] ?><span class="title-og">[Original title]</span><span class="manga-author"><a href=author.php?author_id=<?= $author['id'] ?>>by&nbsp;[author name]<?= $author['name'] ?></a></span></span></p>

                            <p class="manga-disc"> <?= $manga['description'] ?></p>
                        </div>
                    </div>
                    <table class="ssb-font manga-ch">
                        <?php
        foreach ($chapters as $chapter) {
            ?>
                        <tr class="glass">
                            <td class="ch-title"><?= $chapter['number'] ?>.&nbsp;[Chapter name here]</td>
                            <td class="read-buttons">
                                <a class="ssb-butt ssb-butt-sm ssb-hm" style="position: relative;" href="reader.php?manga_id=<?= $manga['id'] ?>&num_chapter=<?= $chapter['number'] ?>"><span class=wtr>Read here</span></a>
                                <a class="ssb-butt ssb-butt-sm ssb-tw" style="position: relative;" href="author.php"><span class=wtr>Read on Twitter</span></a>
                                <a class="ssb-butt ssb-butt-sm ssb-md" style="position: relative;" href="author.php"><span class=wtr>Read on MangaDex</span></a>
                                <a class="ssb-butt ssb-butt-sm ssb-dy" style="position: relative;" href="author.php"><span class=wtr>Read on Dynasty Scans</span></a>
                            </td>

                        <?php
        }
        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>

</html>
