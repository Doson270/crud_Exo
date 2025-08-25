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
    <link rel="stylesheet" href="style/bootstrap.min.css">
</head>
<body>
  <main>
    <form method="post">
      <label for="bookTitle" class="form-label mt-4">Titre du livre</label>
      <input type="text" name="bookTitle" class="form-control" id="bookTitle" aria-describedby="emailHelp" placeholder="Titre du livre" value="<?= $currentBook["title"] ?>">
      <label for="bookDesc">Description du livre</label>
      <textarea name="bookDesc" id="bookDesc" class="form-control" placeholder="Descrption du livre"><?= $currentBook["description"] ?></textarea>
      <label for="bookAuthor">Auteur du livre</label>
      <input type="text" id="bookAuthor" name="bookAuthor" class="form-control" placeholder="Auteur du livre" value="<?= $currentBook["author"] ?>">
      <input type="submit" value="Modifier" class="btn btn-primary">
    </form>
  </main>
</body>
</html>
