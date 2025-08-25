<?php
  require_once "database/database.php";
  $errors = [];
  $pdo = dbLog();

  $bookId = $_GET["id"];
  $request = $pdo->prepare("SELECT * FROM books WHERE id = ?");
  $request->execute([$bookId]);
  $currentBook = $request->fetch();

  if(!$currentBook) {
    header("location: index.php");
    exit();
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bookTitle = (!empty($_POST["bookTitle"]) ? $_POST["bookTitle"] : $currentBook["title"]);
    $bookDesc = (!empty($_POST["bookDesc"]) ? $_POST["bookDesc"] : $currentBook["description"]);
    $bookAuthor = (!empty($_POST["bookAuthor"]) ? $_POST["bookAuthor"] : $currentBook["author"]);
    try {
      $request = $pdo->prepare("UPDATE books SET title = ?, description = ?, author = ? WHERE id = ?");
      $request->execute([$bookTitle, $bookDesc, $bookAuthor, $bookId]);
    } catch (PDOException $e) {
      $errors[] = "Erreur : ".$e->getMessage();
    }
  }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBook - Edition</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/include.css">
</head>
<body>
  <header>
    <?php include "include/header.php" ?>
  </header>
  <main>
    <section class="sectionForm">
      <h1>Modifier un livre</h1>
    <form method="post">
      <input type="text" name="bookTitle" class="form-control" id="bookTitle" aria-describedby="emailHelp" placeholder="Titre du livre" value="<?= $currentBook["title"] ?>">
      <textarea name="bookDesc" id="bookDesc" class="form-control" placeholder="Descrption du livre"><?= $currentBook["description"] ?></textarea>
      <input type="text" id="bookAuthor" name="bookAuthor" class="form-control" placeholder="Auteur du livre" value="<?= $currentBook["author"] ?>">
      <input type="submit" value="Modifier" class="btn btn-primary">
    </form>
    </section>
  </main>
  <footer>
    <?php include "include/footer.php" ?>
  </footer>
</body>
</html>
