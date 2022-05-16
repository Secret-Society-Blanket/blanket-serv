<?php include __DIR__ . '/../scripts/login.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/normalize.css">
    <link rel="stylesheet" href="../style/tw-snippets.css">
    <link rel="stylesheet" href="../style/ssb.css">
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
    <title>Admin Login Page</title>
</head>

<body class="ssb-bg">
    <div class="main-cont antialiased">
        <div class="center-cont ssb-font">
            <div id="swup" class="transition-slide">
                <p style="font-size: 30px; padding-bottom: 0.5em;" class="ssb-font"><span class="rainbow">Admin Login</span></p>
                <p style="margin: 0.2em"><?=$logged_in ?></p>
                <p style="margin: 0.2em"><?= $result ?></p>
                <form action="<?php $_PHP_SELF ?>" method="POST">
                    <input type="text" id="username" placeholder="Username" name="username" class="input"> <br>
                    <input type="password" id="password" placeholder="Password" name="password"> <br>
                    <input type="submit" value="Submit" class="submit transition" data-swup-transition="left"/>
                </form>
            </div>
        </div>
    </div>
</body>

</html>