<?php
include __DIR__ . '/scripts/show_manga.php';
?>
<html>

<head>
    <title><?= $manga['title'] ?></title>
    <link rel="stylesheet" type="text/css" href="/style/main.css" />
</head>

<body>
    <h1><?= $manga['title'] ?></h1>
    <div class="details">
        <p> <?= $manga['description'] ?></p>
        <img class="cover" src="content/<?= $manga['image_link'] ?>"></img>
    </div>
    <h2> Chapters </h2>
    <a href="<?= buildMangaUrl($manga['id'], $lastChapter['number']) ?>"> Latest Release </a></br></br>
    <table>
        <tr>
            <th>Chapter Number</th>
            <th>Author</th>
            <th>Release</th>
            <th>Credits</th>
        </tr>

        <?php
        foreach ($chapters as $chapter) {
        ?>
            <tr>
                <td>
                    <a href=<?= buildMangaUrl($manga['id'], $chapter["number"]) ?>>
                        <div>
                            <?= $chapter['title'] ?>
                        </div>
                    </a>
                </td>
                <td> <a href=author.php?author_id=<?= $author['id'] ?>><?= $author['name'] ?></a> </td>
                <td> <?= $chapter['release_date'] ?> </td>
                <td> <?= $chapter['credits'] ?> </td>
            </tr>

        <?php
        }
        ?>
    </table>

</body>

</html>
