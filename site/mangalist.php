<?php include __DIR__ . '/scripts/list_manga.php';
?>

<html>

<head>
    <title> Manga List</title>
</head>

<body>

    <table>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Original Title</th>
            <th>Author</th>
            <th>Description</th>
            <th>Number Chapters</th>
        </tr>
        <?php

        $mangas = (getSqlRows($db, $MANGA_TABLE));

        while ($manga = mysqli_fetch_array($mangas)) {
            $author = getSqlRowFromId($db, $AUTHOR_TABLE, $manga['author_id']);
        ?>
            <tr>
                <td> <img src=content/<?= $manga['image_link'] ?>></img> </td>
                <td> <?= $manga['title'] ?> </td>
                <td> <?= $manga['original_title'] ?> </td>
                <td> <a href="author.php?author_id=<?=$author['id']?>"> <?= $author['name'] ?> </a></td>
                <td> <?= $manga['description'] ?> </td>
                <td> <?= $manga['num_chapters'] ?> </td>

            <?php
            $html_table = $html_table . '</tr>';
        }
            ?>
    </table>
</body>

</html>
