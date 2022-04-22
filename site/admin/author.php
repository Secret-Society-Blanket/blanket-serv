<?php
include __DIR__ . '/../scripts/new_author.php';

?>

<html>

<head>
    <title>
        Create Author
    </title>
</head>

<body>

    <!-- Try not to change any of the things here, CSS is fine. -->
    <form action="<?php $_PHP_SELF ?>" method="POST" enctype="multipart/form-data">
        <label for="author-name"> Name: </label><br>
        <input type="text" id="author-name" name="author-name" /><br>
        <label for="image"> Avatar </label><br>
        <input type="file" id="image" name="image" /><br>
        <label for="social-links"> Social Links (space-seperated): </label><br>
        <input type="text" id="social-links" name="social-links" /><br>
        <input type="submit" value="Submit" />
    </form>
</body>

</html>
