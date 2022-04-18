<?php
require __DIR__ . '/utils.php';
$config = getConfig();
$db = getSqli();
if ($_POST) {
    // If this is set, we're updating a manga, not creating a new one.
    if (isset($_POST["manga-id"])) {
        $prep = mysqli_prepare(
            $db,
            "UPDATE manga SET title = ?, original_title = ?, author_id = ? , description = ?, image_link = ?, num_chapters = ? WHERE id = ?"
        );
        mysqli_stmt_bind_param(
            $prep,
            'ssissii',
            $title,
            $ogtitle,
            $authorid,
            $description,
            $imageLink,
            $chaps,
            $mangaid
        );
        $title = $_POST["manga-title"];
        $ogtitle = $_POST["manga-original-title"];
        $authorid = $_POST["authors"];
        $description = $_POST["description"];
        $imageLink = $_POST["image-link"];
        $mangaid = $_POST["manga-id"];
        if (isset($_POST["is-oneshot"])) {
            $chaps = NULL;
        } else {
            $nresults = mysqli_query($db, "SELECT * FROM manga WHERE id = '" . $_POST["manga-id"] . "'");
            $nmanga = mysqli_fetch_array($nresults);
            $chaps = $nmanga["num_chapters"];
        }
        mysqli_stmt_execute($prep);
    } else {
        $prep = mysqli_prepare(
            $db,
            "INSERT INTO manga (title, original_title, author_id, description, image_link, num_chapters) VALUES (?, ?, ?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param($prep, 'ssissi', $title, $ogtitle, $authorid, $description, $imageLink, $chaps);
        $title = $_POST["manga-title"];
        $ogtitle = $_POST["manga-original-title"];
        $authorid = $_POST["authors"];
        $description = $_POST["description"];
        $imageLink = $_POST["image-link"];
        if (isset($_POST["is-oneshot"])) {
            $chaps = NULL;
        } else {
            $chaps = 0;
        }
        mysqli_stmt_execute($prep);
    }
}
if (isset($_GET["manga-id"])) {

    $results = mysqli_query($db, "SELECT * FROM manga WHERE id = '" . $_GET["manga-id"] . "'");
    $manga = mysqli_fetch_array($results);
    $getTitle = $manga["title"];
    $getAuthor = $manga["author_id"];
    $getOriginalTitle = $manga["original_title"];
    $getDescription = $manga["description"];
    $getImageLink = $manga["image_link"];
    if ($manga["num_chapters"] == null) {
        $isOneShot = "is-oneshot";
    } else {
        $isOneShot = NULL;
    }
} else {
    $getTitle = NULL;
    $getAuthor = NULL;
    $getOriginalTitle = NULL;
    $getDescription = NULL;
    $getImageLink = NULL;
    $isOneShot = NULL;
}
?>
<html>

<head>
    <title>
        Create Manga
    </title>
</head>

<body>
    <form action="<?php $_PHP_SELF ?>" method="GET">
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
        <input type="submit" value="Load Manga To Edit">
    </form>
                          
    <form action="<?php $_PHP_SELF ?>" method="">
        <input type="submit" value="Make New Manga">
    </form>
    <form action="<?php $_PHP_SELF ?>" method="POST">
        <?php
        if ($_GET) {
            echo ('<input type="hidden" id="manga-id" name="manga-id" value="' . $_GET["manga-id"] . '">');
        }
        ?>
        <label for="manga-title"> Title: </label><br>
        <input type="text" id="manga-title" name="manga-title" value="<?php echo ($getTitle); ?>"><br>
        <label for="manga-original-title"> Original Title: </label><br>
        <input type="text" id="manga-original-title" name="manga-original-title" value="<?php echo ($getOriginalTitle); ?>"><br>
        <label for=" image-link"> Cover Image (link): </label><br>
        <input type="text" id="image-link" name="image-link" value="<?php echo ($getImageLink); ?>"><br>
        <label for=" authors"> Author: </label><br>
        <select id="authors" name="authors">
            <?php

            $config = getConfig();
            $db = getSqli();
            $results = mysqli_query($db, "SELECT * FROM authors");
            while ($author = mysqli_fetch_array($results)) {
                $select = NULL;
                if ($author['id'] == $getAuthor) {
                    $select = "selected";
                }
                echo ("<option value=\"" . $author['id'] . "\" selected=\"" . $select . "\">");
                echo ($author['name']);
                echo ("</option>");
            }
            ?>
        </select><br>
        <input type="checkbox" id="is-oneshot" name="is-oneshot" value="is-oneshot">
        <label for="is-oneshot">Is a Oneshot?</label><br>
        <label for="description"> Description: </label><br>
        <textarea id="description" name="description"><?php echo ($getDescription) ?></textarea><br>
        <input type="submit" value="Submit" />
    </form>
</body>

</html>
