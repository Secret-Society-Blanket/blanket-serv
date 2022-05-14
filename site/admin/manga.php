<?php
require __DIR__ . '/../scripts/new_manga.php';
?>
<html>

<head>
    <title>
        Create Manga
    </title>
</head>

<body> <form action="<?php $_PHP_SELF ?>" method="GET">
        <select id="manga-id" name="manga-id">
            <?= $mangas ?>
        </select>
        <input type="submit" value="Load Manga To Edit">
    </form>

    <form action="<?php $_PHP_SELF ?>" method="">
        <input type="submit" value="Make New Manga">
    </form>

    <form action="<?php $_PHP_SELF ?>" method="POST" enctype="multipart/form-data">
        <?= $hidden ?>
        <label for="manga-title"> Title: </label><br>
        <input type="text" id="manga-title" name="manga-title" value="<?= $getTitle ?>"><br>
        <label for="manga-original-title"> Original Title: </label><br>
        <input type="text" id="manga-original-title" name="manga-original-title" value="<?= $getOriginalTitle ?>"><br>
        <label for="image"> Cover Image: </label><br>
        <input type="file" id="image" name="image"><br>
        <label for=" authors"> Author: </label><br>
        <select id="authors" name="authors">
            <?= $authors ?>
        </select><br>
        <input type="checkbox" id="is-oneshot" name="is-oneshot" value="<?= $isOneshot ?>">
        <label for="is-oneshot">Is a Oneshot?</label><br>
        <label for="description"> Description: </label><br>
        <textarea id="description" name="description"><?= $getDescription ?></textarea><br>
        <input type="submit" value="Submit" />
    </form>
</body>

</html>
