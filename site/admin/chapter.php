<?php include __DIR__ . '/scripts/new_chapter.php'
?>

<html>

<head>
    <title>
        Create Chapter </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <form action="scripts/addChapter.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <label for="manga-id"> Manga: </label>
        <select id="manga-id" name="manga-id" />
        <option value='-1'> Choose a Manga </option>
        <?= $mangas ?>
        </select><br>
        <label for="number"> Chapter Number: </label>
        <input type="number" id="number" name="number" /><br>
        <label for="file"> Upload Files: </label>
        <input type="file" id="file" name="file" /><br>
        <label for="release-date"> Release Date: </label>
        <input type="date" id="release-date" name="release-date" /><br>
        <label for="credits"> Scanlation Credits: </label><br>
        <textarea id="credits" name="credits" /></textarea><br>
        <input type="submit" id="submit" value="Submit" /><br>
    </form>
    <script>
        $('#manga-id').change(function() {
            if ($('#manga-id').val() != -1) {
                $.get("getId.php", {
                    'manga-id': $("#manga-id").val()
                }, function(data) {
                    console.log('FUUUUCK');
                    let row = data;
                    let maxNum;
                    let minNum = 0;
                    if (!row.isOneshot) {
                        maxNum = row.num_chapters + 1;
                    } else {
                        maxNum = 1;
                        minNum = 1;
                    }
                    $("#number").val(maxNum);
                    $("#number").attr('max', maxNum);
                    $("#number").attr('min', minNum);
                }, 'json').done();
            }
        });
    </script>

</body>

</html>
