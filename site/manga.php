<?php
include __DIR__ . '/scripts/show_manga.php';
?> <html>

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

<body class="ssb-bg">
    <div id="swup" class="transition-slide">
        <div class="main-cont antialiased">
            <div id="fade-enabled" class="center-cont ssb-font fade">
                <div class="manga-main">
                    <img class="manga-cover" style="" src="content/<?= $manga['image_link'] ?>"></img>
                    <div class="fc info-align">
                        <div class="glass b-r fc card-width" style="padding: 5px 7px 7px 7px;">
                            <p style="font-size: 45px;"><span class="title-en" style="display: inline-block;"><?= $manga['title'] ?></span></p>
                            <p class="title-og"><?= $manga['original_title'] ?></p>
                            <p style="padding: 3px 0px 10px 0px"><span class="manga-author">
                                    <a href="/author.php?author_id=<?= $author['id'] ?>" data-swup-transition="left" class="transition">by&nbsp<?= $author['name'] ?></a></span></p>
                            <p>Last updated <?= $lastChapter['release_date'] ?></p>
                            <?php
                            if (!$manga['is_oneshot']) {
                            ?>
                            <p><?= $manga['num_chapters'] ?> chapters</p>
                            <?php
                                    } else {
                                    ?>
                            <p>Oneshot</p>
                            <?php
                            }
                            ?>
                        </div>


                        <div class="glass b-r fc card-width" style="padding: 5px; align-items: center;">
                            <p style="padding: 0px 0px 5px 0px">Read the latest chapter</p>
                            <?php

                            function buildButton($available, $title, $link, $style)
                            {

                                if (!$available) {
                                    $out = "<a class=\"ssb-butt-disabled ssb-butt-sm $style\" style=\"border-radius: 4px;\">$title<span class=\"tip no-permissions\">This title is<br>not available<br>on $title.</span></a>";
                                } else {
                                    $out = "<a href=\"$link\" class=\"ssb-butt ssb-butt-sm transition $style\" style=\"border-radius: 4px;\">$title</a>";
                                }
                                return $out;
                            }
                            ?>
                            <div class="fr latest-butt">

                                <?= buildButton(!$lastChapter['local'], "SSB Reader", buildMangaUrl($manga['id'], $lastChapter['number']), "ssb-hm") ?>
                                <?= buildButton($lastChapter['twitter'], "Twitter", $lastChapter['twitter'], "ssb-tw") ?>

                                <?= buildButton($lastChapter['mangadex'], "Mangadex", $lastChapter['mangadex'], "ssb-md") ?>
                                <?= buildButton($lastChapter['dynasty'], "Dynasty Scans", $lastChapter['dynasty'], "ssb-dy") ?>
                            </div>
                        </div>


                </div>
                <table class="ssb-font manga-ch">
                    <?php
                    foreach ($chapters as $chapter) {
                        $nodisplay = "display:none;";
                        $lc = !$chapter['local'] ? "" : $nodisplay;
                        $md = $chapter['mangadex'] ? "" : $nodisplay;
                        $tw = $chapter['twitter'] ? "" : $nodisplay;
                        $dy = $chapter['dynasty'] ? "" : $nodisplay;
                        $chapnum = $manga['is_oneshot'] ? "" : $chapter['number'] . ". ";
                    ?>
                    <tr class="glass" style="align-items: center;">
                        <td class="ch-title"><?= $chapnum ?><?= $chapter['title'] ?></td>
                        <td class="read-buttons">
                            <a class="ssb-butt ssb-butt-sm ssb-hm" style="position: relative; <?= $lc ?>" href="<?= buildMangaUrl($manga['id'], $chapter['number']) ?>"><span class="tip read-hint">Read here</span></a>
                            <a class="ssb-butt ssb-butt-sm ssb-tw" style="position: relative; <?= $tw ?>" href="<?= $chapter['twitter'] ?>"><span class="tip read-hint">Read on Twitter</span></a>
                            <a class="ssb-butt ssb-butt-sm ssb-md" style="position: relative; <?= $md ?>" href="<?= $chapter['mangadex'] ?>"><span class="tip read-hint">Read on MangaDex</span></a>
                            <a class="ssb-butt ssb-butt-sm ssb-dy" style="position: relative; <?= $dy ?>" href="<?= $chapter['dynasty'] ?>"><span class="tip read-hint">Read on Dynasty Scans</span></a>
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
        <div class="footer-main antialiased">
            <div class="footer-content">
                <ul id="breadcrumb" class="breadcrumb ssb-font" style="padding: 0.2em;">
                    <li><a data-swup-transition="right" href="/index.html">Home</a></li>
                    <li><a data-swup-transition="right" href="/mangalist.php">Manga List</a></li>
                    <li><a><?= $manga['title'] ?></a></li>
                </ul>
            </div>
        </div>
    </div>
    <script defer src="js/scroll-arrow-min.js"></script>
</body>

</html>