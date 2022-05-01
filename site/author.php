<?php
include __DIR__ . '/scripts/show_author.php';
?>
<html>

<head>
    <title><?= $author['name'] ?></title>
</head>

<body>
    <h1><?= $author['name'] ?></h1>
    <p> <?= $author['links'] ?></p>
    <img src=content/<?= $author['avatar_link'] ?>></img>
    <h2> Manga </h2>
    <table>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
        </tr>
        <?php
        while ($manga = mysqli_fetch_array($mangas)) {
            $author = getSqlRowFromId($db, $AUTHOR_TABLE, $manga['author_id']);
            // This should link to the author
        ?>
            <tr>
                <td> <img src=content/<?= $manga['image_link'] ?>></img> </td>
                <td> <?= $manga['title'] ?> </td>
                <td> <?= $manga['description'] ?> </td>

            <?php
            $html_table = $html_table . '</tr>';
        }
            ?>
    </table>

</body>

</html>
