<?php
include __DIR__ . '/../scripts/new_author.php';

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
    <title>
        Add/Edit Authors
    </title>
</head>

<body class="ssb-bg">
    <div class="main-cont antialiased">
        <div class="center-cont ssb-font">
            <p style="font-size: 30px; padding-bottom: 1em;" class="ssb-font"><span class="rainbow">Create an author</span></p>
            <!-- Try not to change any of the things here, CSS is fine. -->
            <form action="<?php $_PHP_SELF ?>" method="POST" enctype="multipart/form-data">
                <input type="file" id="image" name="image" class="file"/>
                <label for="image" class="file">Author image</label><br>
                <input type="text" id="author-name" name="author-name" placeholder="Author name" class="input" /><br>
                <input type="text" id="social-links" name="social-links" name="author-name" placeholder="Social links" class="input"/><br>
                <input type="submit" value="Submit" class="submit"/>
            </form>
            <a class="ssb-butt ssb-butt-sm ssb-blk" href="index.php">Back</a>
            <p> <?= $command_result ?></p>
        </div>
    </div>
</body>

</html>
