<?php
include __DIR__ . '/scripts/show_manga.php';
?> <html>

<head>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="style/normalize.css">
        <link rel="stylesheet" href="style/tw-snippets-min.css">
        <link rel="stylesheet" href="style/ssb-min.css">
        <script src="https://unpkg.com/swup@latest/dist/swup.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
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
                <div id="fade-enabled" class="center-cont ssb-font fade">
                    <div class="manga-main">
                        <img class="manga-cover" style="" src="img/1.png"></img>
                        <div class="fc info-align">
                            <div class="glass b-r fc card-width" style="padding: 5px 7px 7px 7px;">
                                <p style="font-size: 45px;"><span class="title-en" style="display: inline-block;"><?= $manga['title'] ?> + length for testing</span></p>
                                <p class="title-og">キューブ・ゲーム・ザ・ベイス・アーク</p>
                                <p style="padding: 3px 0px 10px 0px"><span class="manga-author">
                                        <a href=author.php?author_id=<?= $author['id'] ?>>by&nbsp;[author name]<?= $author['name'] ?></a></span></p>
                                <p>Last updated 2022-06-06</p>
                                <p>4 chapters</p>
                            </div>


                            <div class="glass b-r fc card-width" style="padding: 5px; align-items: center;">
                                <p style="padding: 0px 0px 5px 0px">Read the latest chapter</p>
                                <div class="fr latest-butt" style=""><a class="ssb-butt ssb-butt-sm ssb-hm" style="border-radius: 4px;">SSB Reader</a>
                                    <a class="ssb-butt ssb-butt-sm ssb-tw" style="border-radius: 4px;">Twitter</a>
                                    <a class="ssb-butt-disabled ssb-butt-sm ssb-md" style="border-radius: 4px;">MangaDex<span class="tip no-permissions">This title is<br>not available<br>on MangaDex.</span></a>
                                    <a class="ssb-butt-disabled ssb-butt-sm ssb-dy" style="border-radius: 4px;">Dynasty Scans<span class="tip no-permissions">This title is<br>not available<br>on Dynasty Scans.</span></a>
                                </div>
                            </div>
                            <p class="manga-disc glass b-r"> <?= $manga['description'] ?></p>
                        </div>


                    </div>
                    <table class="ssb-font manga-ch">
                        <?php
        foreach ($chapters as $chapter) {
            ?>
                        <tr class="glass">
                            <td class="ch-title"><?= $chapter['number'] ?>.&nbsp;[Chapter name here]</td>
                            <td class="read-buttons">
                                <a class="ssb-butt ssb-butt-sm ssb-hm" style="position: relative;" href="reader.php?manga_id=<?= $manga['id'] ?>&num_chapter=<?= $chapter['number'] ?>"><span class="tip read-hint">Read here</span></a>
                                <a class="ssb-butt ssb-butt-sm ssb-tw" style="position: relative;" href="author.php"><span class="tip read-hint">Read on Twitter</span></a>
                                <a class="ssb-butt ssb-butt-sm ssb-md" style="position: relative;" href="author.php"><span class="tip read-hint">Read on MangaDex</span></a>
                                <a class="ssb-butt ssb-butt-sm ssb-dy" style="position: relative;" href="author.php"><span class="tip read-hint">Read on Dynasty Scans</span></a>
                            </td>
                            <td class="heart" style="font-family: 'JF Dot K14';">♥<span class="tip credits"><?= $chapter['credits'] ?></span></td>
                            <td class="date"><?= $chapter['release_date'] ?></td>
                            
                        </tr>

                        <?php
        }
        ?>
                    </table>

                </div>
                <div class="arrow arrow-up" id="arrow-up"><span class="rainbow">△</span></div>
                <div class="arrow arrow-down" id="arrow-down"><span class="rainbow">▽</span></div>
            </div>
        </div>
        </div>
        <script defer src="js/scroll-arrow-min.js"></script>
    </body>

</html>
