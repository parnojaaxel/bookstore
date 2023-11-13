<?php

require_once("connect.php");

$id = $_GET["id"];

$books = $pdo->query("SELECT * FROM books WHERE id={$id}");

$row = $books->fetch();

$auth = $pdo->query("SELECT * FROM book_authors ba LEFT JOIN authors a ON ba.author_id=a.id WHERE book_id = {$id} ");

$auth_row = $auth->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="title">
        <h1>
            <?=$row["title"]?>
            <p><?=$row["summary"]?></p>
        </h1>
        <h2>
            Year: <?=$row["release_date"]?>
        </h2>
        <img src="<?=$row["cover_path"]?>" alt="DON DON DOOON">
        <h3>
            Price: <?=$row["price"]?>€
        </h3>
        <h3>
            Pages: <?=$row["pages"]?>
        </h3>
        <h3>
            Author: <?=$auth_row["first_name"]?> <?=$auth_row["last_name"]?>
        </h3>
    </div>
    <div class="links">
        <a href="./index.php?id=<?=$row["id"]?>"><p>Back</p></a>
        <a href="./edit.php?id=<?=$row["id"]?>"><p>Muuda</p></a>
    </div>
</body>
</html>