<?php
if ($_POST && ($_POST["author-name"] && $_POST["image-link"] && $_POST["social-links"])) {
    require __DIR__ . '/utils.php';
    $config = getConfig();
    $db = getSqli();
    $prep = mysqli_prepare(
        $db,
        "INSERT INTO authors (name, links, avatar_link)
                            VALUES (?, ?, ?)"
    );
    mysqli_stmt_bind_param($prep, 'sss', $author, $links, $alink);
    $author = $_POST["author-name"];
    $links = $_POST["social-links"];
    $alink = $_POST["image-link"];
    mysqli_stmt_execute($prep);
}
?>
<html>

<head>
    <title>
        Create Author
    </title>
</head>

<body>
    <form action="<?php $_PHP_SELF ?>" method="POST">
        <label for="author-name"> Name: </label><br>
        <input type="text" id="author-name" name="author-name" /><br>
        <label for="image-link"> Image (link): </label><br>
        <input type="text" id="image-link" name="image-link" /><br>
        <label for="social-links"> Social Links (space-seperated): </label><br>
        <input type="text" id="social-links" name="social-links" /><br>
        <input type="submit" value="Submit"/>
    </form>
</body>

</html>
