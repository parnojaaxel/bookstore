<?php
require_once("connect.php");

$id = $_GET["id"];


if (isset($_POST['book_submit'])) {
    $newTitle = $_POST['newTitle'];
    $newReleaseDate = $_POST['newRelease_date'];
    $newPrice = $_POST['newPrice'];
    $newType = $_POST['newType'];

    $isDeleted = isset($_POST['isDeleted']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE books SET title = :title, release_date = :release_date, price = :price, type = :type, isDeleted = :isDeleted WHERE id = :id");
    $stmt->execute([
        'title' => $newTitle,
        'release_date' => $newReleaseDate,
        'price' => $newPrice,
        'type' => $newType,
        'isDeleted' => $isDeleted,
        'id' => $id
    ]);
}

if (isset($_POST['author_submit'])) {
    $    
}

$books = $pdo->query("SELECT * FROM books WHERE id = {$id}");
$row = $books->fetch();

$auth = $pdo->query("SELECT * FROM book_authors ba LEFT JOIN authors a ON ba.author_id=a.id WHERE book_id = {$id} ");

$authors = $pdo->query("SELECT * FROM authors ");
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
            <div class="form_field">
                <h2>Date:</h2>
                <input class="field" type="text" name="newRelease_date" value="<?= $row["release_date"] ?>">
            </div>
            <div class="form_field">
                <h2>Price:</h2>
                <input class="field" type="text" name="newPrice" value="<?= $row["price"] ?>">
            </div>
            <div class="form_field">
                <h2>Type:</h2>
                <label>
                    <input class="field" type="radio" name="newType" value="used" <?php if ($row["type"] == "used") echo 'checked'; ?>> Used
                </label>
                <label>
                    <input class="field" type="radio" name="newType" value="new" <?php if ($row["type"] == "new") echo 'checked'; ?>> New
                </label>
                <label>
                    <input class="field" type="radio" name="newType" value="ebook" <?php if ($row["type"] == "ebook") echo 'checked'; ?>> Ebook
                </label>
            </div>
            <div class="form_field">
                <h2>Is Deleted:</h2>
                <input class="field" type="checkbox" name="isDeleted" value="1" <?php if ($row["isDeleted"] == 1) echo 'checked'; ?>> Is deleted
            </div>
            <input type="submit" value="Save" name="book_submit">
        </form> 
        <h3>
            Authors: 
        </h3>
        <ul>
        <?php
        while ($auth_row = $auth->fetch()) {
        ?>
            <li>
            <?=$auth_row["first_name"]?> <?=$auth_row["last_name"]?>
            </li>
        <?php
        }
        ?>
    </ul>

    <form action="edit.php" method="POST">

    <label for="authors">Choose authors:</label>

    <select name="author_id" id="authors">
    <?php
        while ($author = $authors->fetch()) {
        ?>
            <option value="<?=$author["id"]?>">
            <?=$author["first_name"]?> <?=$author["last_name"]?>
            </option>
        <?php
        }
        ?>
    </select>
    <input type="submit" value="Save" name="author_submit">
    <input type="hidden" name="book_id" value="<?=$id?>">
    </form>

        <a href="./book.php?id=<?=$row["id"]?>"><p>Back</p></a>
    </div>
</body>
</html>
