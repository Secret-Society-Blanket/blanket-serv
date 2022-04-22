<?php
require_once __DIR__ . '/utils.php';
$TEST = "TELKASTJA";
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
