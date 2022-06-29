<?php include __DIR__ . '/../scripts/new_chapter.php'
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
    <script defer src="../js/main.js"></script>
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
    <title>
        Add/Edit Chapters </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body id="bg" class="ssb-bg">
    <div class="main-cont antialiased">
        <div id="fade-enabled" class="center-cont ssb-font fade">
            <p style="font-size: 30px; padding-bottom: 1em;" class="ssb-font"><span class="rainbow">Upload chapter</span></p>

            <form action="<?php $_PHP_SELF ?>" method="GET" style="margin: 0px">
                <select id="chapter_id" name="chapter_id" class="selecter">
                    <option value="" disabled selected >Select an chapter</option>
                    <?= $chapteroption ?>
                </select><br>
                <p class="ssb-font" style="padding-bottom: 0.3em">then</p>
                <input type="submit" value="Load chapter to edit" class="submit">
            </form><br>
            <p class="ssb-font" style="padding-bottom: 0.3em">Or click</p>
            <form action="<?php $_PHP_SELF ?>" method="GET" style="margin: 0px;">
                <input type="submit" value="Make new chapter" class="submit">
            </form>
            <p class="ssb-font" style="padding-bottom: 0.3em">and fill out</p>
            <form action="<?php $_PHP_SELF ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                <?= $hidden ?>
                <select id="manga-id" name="manga-id" />
                <option value="" disabled <?= $defSelectManga ?>>Select a manga</option>
                <?= $mangas ?>
                </select><br>

                <input type="number" id="number" name="number" step="any" placeholder="Chapter number" value="<?= $getNumber ?>" /><br>
                <input type="text" id="chapter-title" name="chapter-title" placeholder="Chapter title" class="input" value="<?= $getTitle ?>" /><br>
                <input type="text" id="twitter-link" name="twitter-link" placeholder="Twitter Link" class="input" value="<?= $getTwitter?>" /><br>
                <input type="text" id="dynasty-link" name="dynasty-link" placeholder="Dynasty Link" class="input" value="<?= $getDynasty ?>" /><br>
                <input type="text" id="mangadex-link" name="mangadex-link" placeholder="Mangadex Link" class="input" value="<?= $getMangadex ?>"/><br>
                <input type="file" id="file" name="file" class="file" />
                <label for="file" class="file">Chapter ZIP</label><br>
                <input type="checkbox" id="external-only" name="external-only" class="checkbox-ex ssb-font" value="Yes" <?= $localonlychecked ?>><br>
                <input type="date" id="release-date" name="release-date" style="margin: 0.2em" value="<?= $getReleaseDate ?>"/><br>
                <textarea id="credits" name="credits" placeholder="Add credits..." style="margin: 0.2rem"><?= $getCredits ?></textarea><br>
                <input type="submit" id="submit" value="Submit" class="submit" /><br>
            </form>
            <a class="ssb-butt ssb-butt-sm ssb-blk" href="index.php">Back</a>
            <p style="margin: 0.2rem"><?= $command_result ?> </p>
            <script>
                $('#manga-id').change(function() {
                    if ($('#manga-id').val() != -1) {
                        $.get("/scripts/getId.php", {
                            'manga-id': $("#manga-id").val()
                        }, function(data) {
                            let row = data;
                            let maxNum;
                            let minNum = 0;
                            if (!row.isOneshot) {
                                maxNum = row.num_chapters + 1;
                            } else {
                                maxNum = 1;
                                minNum = 1;
                            }
                            $("#number").val(maxNum);
                            /* $("#number").attr('max', maxNum); */
                            $("#number").attr('min', minNum);
                        }, 'json').done();
                    }
                });
            </script>
        </div>
        <div class="arrow arrow-up" id="arrow-up"><span class="rainbow">△</span></div>
        <div class="arrow arrow-down" id="arrow-down"><span class="rainbow">▽</span></div>
    </div>
</body>

</html>
