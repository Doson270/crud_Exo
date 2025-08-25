<?php
  require_once "database/database.php";

  $pdo = dbLog();
  if(isset($_GET["id"])) {
    $bookId = $_GET["id"];
    $request = $pdo->prepare("SELECT * FROM books WHERE id = ?");
    $request->execute([$bookId]);
    $book = $request->fetch();
  } else{
    header("location: index.php");
    exit();
  }
  if(!$book) {
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
    <link rel="stylesheet" href="style/bootstrap.min.css">
</head>
<body>
    <header>
      <?php include 'include/header.php' ?>
    </header>
    <main>
      <?= $book["title"] ?>
      <?= $book["description"] ?>
      <?= $book["author"] ?>
    </main>
    <footer>
        <?php include 'include/footer.php' ?>
    </footer>
</body>
</html>
