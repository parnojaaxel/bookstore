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
    <div class="textington">
        <div class="title">
            <h1>
                <?=$row["title"]?>
            </h1>
        </div>
        <div class="release">
            Release date:
             <?=$row["release_date"]?>
        </div>
    </div>
</body>
</html>