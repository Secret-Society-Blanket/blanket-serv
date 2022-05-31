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
            <th>Links</th>
            <th>Release</th>
            <th>Credits</th>
        </tr>

        <?php
        foreach ($chapters as $chapter) {
            // This will contain each active link.
            $links = "";
            if ($chapter["local"]) {
                $links .= "<a href='{$buildMangaUrl($manga['id'],$chapter['number'])}'> Local </a>";
            }
            if ($chapter["twitter"] != "") {
                $links .= "<a href='{$chapter['twitter']}'> Twitter </a>";
            }

            if ($chapter["dynasty"] != "") {
                $links .= "<a href='{$chapter['dynasty']}'>Dynasty-Scans </a>";;
            }

            if ($chapter["mangadex"] != "") {
                $links .= "<a href='{$chapter['mangadex']}'>Mangadex </a>";;
            }
            if ($links == "") {
                $links = "No links found.";
            }
        ?>
            <tr>
                <td>
                    <?= $chapter['title'] ?>
                </td>

                <td> <a href=author.php?author_id=<?= $author['id'] ?>><?= $author['name'] ?></a> </td>

                <td>
                                                <?= $links ?>
                </td>
                <td> <?= $chapter['release_date'] ?> </td>
                <td> <?= $chapter['credits'] ?> </td>
            </tr>

        <?php
        }
        ?>
    </table>

</body>

</html>
