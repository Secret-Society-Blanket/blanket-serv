<?php
require __DIR__ . '/utils.php';
$config = getConfig();
$db = getSqli();
?>
<html>

<head>
    <title>
        Create Chapter
    </title>
</head>

<body>
    <form action="<?php $_PHP_SELF ?>" method="POST">
        <label for="manga-id"> Manga: </label>
        <select id="manga-id" name="manga-id">
            <?php
            $config = getConfig();
            $db = getSqli();
            $results = mysqli_query($db, "SELECT * FROM manga");
            while ($manga = mysqli_fetch_array($results)) {
                echo ("<option value=\"" . $manga['id'] . "\">");
                echo ($manga['title']);
                echo ("</option>");
            }
            ?>
        </select>
        <label for="title"> Chapter Title: </label>
        <input type="text" id="title" name="title"><br>
        <label for="number"> Chapter Number: </label>
        <input type="number" id="number" name="number"><br>
                          <label for="file"> Upload Files: </label>
                          <input type="file" id="file" name="file"><br>

    </form>
</body>

</html>
