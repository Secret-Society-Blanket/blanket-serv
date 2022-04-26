<?php include __DIR__ . '/../scripts/login.php';
?>
<html>

<head>
    <title>Admin Login Page</title>
</head>

<body>
    <h1> Admin Login </h1>
    <?=$logged_in ?>
    <p> <?= $result ?> </p>
    <form action="<?php $_PHP_SELF ?>" method="POST">
        <label for="username"> Username: </label>
        <input type="text" id="username" name="username"> <br>
        <label for="password"> Password: </label>
        <input type="password" id="password" name="password"> <br>
        <input type="submit" value="Submit" />
    </form>

</body>

</html>
