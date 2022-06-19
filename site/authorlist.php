<?php
include __DIR__ . '/scripts/list_authors.php';
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
        <title>Author List</title>
        <link rel="stylesheet" type="text/css" href="/style/main.css" />
    </head>

    <body class="ssb-bg">
        <div id="swup" class="transition-slide">
            <div class="main-cont antialiased">
                <div id="fade-enabled" class="center-cont ssb-font fade">
                    <div class="card-list">
                        <?php
                        usort($authors,
                              function ($left, $right)
                            {
                                return ($left['name'] <=> $right['name']);
                            }
                        );

                        foreach ($authors as $author) {
                            $link = "/author.php?id={$author['id']}";

                        ?>
                        <div class="fc b-r card glass">
                            <a href="<?=$link?>" class="transition" data-swup-transition="left"><img class="card-image author-card-image" style="background: white;" src="/content/<?=$author['avatar_link']?>"></img></a>
                            <a style="font-size: 30px; line-height: 0.8em; margin-bottom: 5px;" class="transition" data-swup-transition="left" href="<?=$link?>"><?=$author['name']?><a />
                                <a style="font-size: 15px; line-height: 1em; margin-bottom: 5px; font-family: 'JF Dot K14'" class="transition" data-swup-transition="left" href="<?=$link?>"><?=$author['japanese_name']?><a />
                        </div>
                    <?php
                    } ?>
                    </div>
                </div>
                <div class="arrow arrow-up" id="arrow-up"><span class="rainbow">△</span></div>
                <div class="arrow arrow-down" id="arrow-down"><span class="rainbow">▽</span></div>
            </div>
            <div class="footer-main antialiased">
                <div class="footer-content">
                    <ul id="breadcrumb" class="breadcrumb ssb-font" style="padding: 0.2em;">
                        <li><a data-swup-transition="right" href="/index.html">Home</a></li>
                        <li><a>Author List</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </body>

</html>
