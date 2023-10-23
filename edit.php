<?php
require_once("connect.php");

$id = $_GET["id"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newTitle = $_POST['newTitle'];
    $stmt = $pdo->prepare("UPDATE books SET title = :title WHERE id = :id");
    $stmt->execute(['title' => $newTitle, 'id' => $id]);
}

$books = $pdo->query("SELECT * FROM books WHERE id = {$id}");
$row = $books->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Title</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="title">
        <h1>
            <?php if (isset($_POST['newTitle'])) {
                echo $_POST['newTitle'];
            } else {
                echo $row["title"];
            } ?>
        </h1>
        <form class="form" method="POST">
            <div class="form_field">
                <h2>Title:</h2>
                <input class="field" type="text" name="newTitle" value="<?= $row["title"] ?>">
            </div>
            <input type="submit" value="Save">
        </form>
    </div>
</body>
</html>