<?php
include __DIR__ . '/scripts/show_author.php';
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
    <title><?= $author['name'] ?></title>
    <link rel="stylesheet" type="text/css" href="/style/main.css" />
</head>

<body class="ssb-bg">
    <div id="swup" class="transition-slide">
        <div class="main-cont antialiased">
            <div id="fade-enabled" class="center-cont ssb-font fade">
                <div class="manga-main">
                    <div class="fc" style="flex: 0 0 200px; align-items: center; padding-right: 5px;">
                        <img class="author-image card-width" src="content/<?= $author['avatar_link'] ?>"></img>
                        <div class="glass b-r fc card-width" style="padding: 5px 7px 7px 7px;">
                            <p style="font-size: 45px;"><span class="title-en" style="display: inline-block;"><?= $author['name'] ?></span></p>
                            <p style="padding-top: 5px;" class="title-og">[Author name JP]</p>
                        </div>
                    </div>
                    <div class="fc info-align" style="flex-basis: 1;">
                        <div class="glass b-r fc card-width" style="padding: 5px; align-items: center;">
                            <p class="glass b-r warning-sfw" style="padding: 5px; padding-bottom: 8px;">This author is SFW or has<br>a separate NSFW account.</p>
                            <p class="glass b-r warning-nsfw" style="padding: 5px; padding-bottom: 8px;margin-bottom: 10px;">This author posts NSFW things.<br>Click at your own risk!</p>
                            <div class="fr latest-butt">
                                <a href="[Twitter link]" class="ssb-butt ssb-butt-sm ssb-tw" style="border-radius: 4px; padding: 8px;"><span class="fr" style="align-items: center;"><img class="mini-logo" src="img/twitter.png"></img><span style="padding-bottom: 1px;">&nbsp;&nbsp;Twitter</span></span></a>
                                <a href="[Pixiv link]" class="ssb-butt ssb-butt-sm ssb-px" style="border-radius: 4px; padding: 8px;"><span class="fr" style="align-items: center;"><img class="mini-logo" src="img/pixiv.png"></img><span style="padding-bottom: 1px;">&nbsp;&nbsp;Pixiv</span></span></a>
                            </div>
                        </div>
                        <p class="manga-disc glass b-r">[Author description] blam blam sham plam damn now that is a description uwu owo yeah baby vine boom blam blam sham plam damn now that is a description uwu owo yeah baby vine boom</p>
                    </div>
                </div>
                <div class="card-list">
                    <?php
        while ($manga = mysqli_fetch_array($mangas)) {
            $author = getSqlRowFromId($db, $AUTHOR_TABLE, $manga['author_id']);
            // This should link to the author
        ?>
                    <div class="fc b-r card glass">
                        <a href="manga.php?manga_id=<?= $manga['id'] ?>"><img class="card-image" style="background: white;" src=content/<?= $manga['image_link'] ?>></img></a>
                        <a style="font-size: 30px; line-height: 0.8em; margin-bottom: 5px;" href="manga.php?manga_id=<?= $manga['id'] ?>"> <?= $manga['title'] ?></a>
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
        <script defer src="../js/scroll-arrow-min.js"></script>
</body>

</html>