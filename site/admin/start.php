<?php include __DIR__ . '/../scripts/setup.php';
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
    <title>Setup Page</title>
</head>

<body class="ssb-bg">
    <div class="main-cont antialiased">
        <div class="center-cont ssb-font">
            <p style="font-size: 30px; padding-bottom: 1em;" class="ssb-font"> Create an <span class="rainbow">admin account!</span></p>
            <form action="<?php $_PHP_SELF ?>" method="POST">
                <input type="text" id="username" placeholder="Username" name="username" class="input"> <br>
                <input type="password" id="password" placeholder="Password" name="password"> <br>
          <label for="reset">Reset Database?</label> 
          <input type="checkbox" id="reset" name="reset" value="Yes">
                <input type="submit" value="Submit" class="submit"/>
            </form>

            <p> <?= $result ?> </p>
        </div>
    </div>
</body>

</html>
