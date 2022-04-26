<?php include __DIR__ . '/../scripts/setup.php';
?>
<html>

<head>
    <title>Setup Page</title>
</head>

<body>
    <form action="<?php $_PHP_SELF ?>" method="POST">
        <label for="username"> Username: </label>
        <input type="text" id="username" name="username"> <br>
        <label for="password"> Password: </label>
        <input type="password" id="password" name="password"> <br>
        <input type="submit" value="Submit" />
    </form>

    <p> <?= $result ?> </p>
</body>

</html>
