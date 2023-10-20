<?php

require_once('.env');

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $options);

$id = $_GET["id"];

$stmt = $pdo->query("SELECT * FROM books WHERE id={$id}");

$row = $stmt->fetch();

$auth = $pdo->query("SELECT * FROM book_authors ba LEFT JOIN authors a ON ba.author_id=a.id WHERE book_id = {$id} ");

$auth_row = $auth->fetch();$auth = $pdo->query("SELECT * FROM book_authors ba LEFT JOIN authors a ON ba.author_id=a.id WHERE book_id = {$id} ");

$auth_row = $auth->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['title']?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="text">
        <div class="title">
            <h1>
                <?=$row["title"]?>
            </h1>
        </div>
        <div class="stuff">
            <div>
                Release date:
                <?=$row["release_date"]?>
            </div>
            <div>
                Pages:
                <?=$row["pages"]?>
            </div>
            <div>
                Price:
                <?=$row["price"]?>$
            </div> 
            <div>
                Author:
                <?=$auth_row["first_name"]?> <?=$auth_row["last_name"]?>
            </div> 
        </div>        
    </div>
    <div class="image">
        <img src="<?=$row["cover_path"]?>" alt="NINJA BALLS WAS HERE">
        <a href="./edit.php?id=<?= $row['id']?>">Muuda</a>
    </div>

    
</body>
</html>