<?php
  require_once "database/database.php";

  $pdo = dbLog();
  if(isset($_GET["id"])) {
    $bookId = $_GET["id"];
    $request = $pdo->prepare("SELECT * FROM books WHERE id = ?");
    $request->execute([$bookId]);
    $book = $request->fetch();
  }

  if(!$book) {
    header("location: index.php");
    exit();
  }

  if(isset($_GET["delete"]) && isset($_GET["id"])) {
    $bookId = $_GET["id"];
    $request = $pdo->prepare("DELETE FROM books WHERE id = ?");
    $request->execute([$bookId]);
    header("location: index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/include.css">
</head>
<body>
    <header>
        <?php include 'include/header.php' ?>
    </header>
    <main>
      <?= $book["title"] ?>
      <?= $book["description"] ?>
      <?= $book["author"] ?>
      <a href="?delete=1&id=<?= $book["id"] ?>">Supprimer</a>
    </main>
    <footer>
        <?php include 'include/footer.php' ?>
    </footer>
</body>
</html>
