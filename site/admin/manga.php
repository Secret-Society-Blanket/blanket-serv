<?php
require __DIR__ . '/../scripts/new_manga.php';
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
    <script defer src="../js/selecter.js"></script>
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
    <title>
        Add/Edit Manga
    </title>
</head>

<body class="ssb-bg">
    <div class="main-cont antialiased">
        <div id="fade-enabled" class="center-cont ssb-font fade">
            <p style="font-size: 30px; padding-bottom: 1em;" class="ssb-font"><span class="rainbow">Create/edit a manga</span></p>
            <form action="<?php $_PHP_SELF ?>" method="GET" style="margin: 0px">
                <select id="manga-id" name="manga-id" class="selecter">
                    <option value="" disabled selected>Select a manga</option>
                    <?= $mangas ?>
                </select><br>
                <p class="ssb-font" style="padding-bottom: 0.3em">then</p>
                <input type="submit" value="Load manga to edit" class="submit">
            </form><br>
            <p class="ssb-font" style="padding-bottom: 0.3em">Or click</p>
            <form action="<?php $_PHP_SELF ?>" method="GET" style="margin: 0px;">
                <input type="submit" value="Make new manga" class="submit">
            </form>
            <p class="ssb-font" style="padding-bottom: 0.3em">and fill out</p>
            <form action="<?php $_PHP_SELF ?>" method="POST" enctype="multipart/form-data">
                <?= $hidden ?>
                <input type="text" id="manga-title" name="manga-title" placeholder="Title" class="input" value="<?= $getTitle ?>"><br>
                <input type="text" id="manga-original-title" name="manga-original-title" placeholder="JP Title" class="input" style="font-family: 'JF Dot K14'" value="<?= $getOriginalTitle ?>"><br>
                <input type="file" id="image" name="image" class="file" />
                <label for="image" class="file">Choose a cover image</label><br>
                <select id="authors" name="authors" class="selecter">
                    <?= $authors ?>
                    <option value="" disabled selected>Select an author</option>
                </select><br>
                <input type="checkbox" id="is-oneshot" name="is-oneshot" class="checkbox-as ssb-font" value="<?= $isOneshot ?>"><br>
                <textarea id="description" name="description" style="margin: 0.2rem" placeholder="Enter a description..."><?= $getDescription ?></textarea><br>
                <input type="submit" value="Submit" class="submit" />
            </form>
            <a class="ssb-butt ssb-butt-sm ssb-blk" href="index.php">Back</a>
            <p> <?= $command_result ?></p>
        </div>
        <div class="arrow arrow-up" id="arrow-up"><span class="rainbow">△</span></div>
        <div class="arrow arrow-down" id="arrow-down"><span class="rainbow">▽</span></div>
    </div>
    <script defer src="../js/scroll-arrow-min.js"></script>
</body>

</html>
