<?php
require_once("connect.php");

if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $stmt = $pdo->prepare("SELECT * FROM books WHERE title LIKE :searchQuery AND isDeleted = 0");
    $stmt->execute(['searchQuery' => "%$searchQuery%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM books WHERE isDeleted = 0");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
</head>
<body>
    <div>
        <form method="GET">
            <input type="text" name="search" placeholder="Search for books">
            <input type="submit" value="Search">
        </form>
    </div>
    <ul>
        <?php
        while ($row = $stmt->fetch()) {
        ?>
            <li>
                <a href="book.php?id=<?= $row["id"] ?>">
                    <?= $row["title"]; ?>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>
</body>
</html>
