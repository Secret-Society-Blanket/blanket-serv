<?php
require __DIR__ . '/utils.php';
if ($_POST) {
    $db = getSqli();
    $prep = mysqli_prepare(
        $db,
        "INSERT INTO {$AUTHOR_TABLE} (name, links, avatar_link)
                            VALUES (?, ?, ?)"
    );
    mysqli_stmt_bind_param($prep, 'sss', $author, $links, $alink);
    $author = $_POST["author-name"];
    $links = $_POST["social-links"];
    $alink = saveFile($_FILES['image']);
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
