<?php
  require_once "database/database.php";
  $errors = [];
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bookTitle = $_POST["bookTitle"] ?? "";
    $bookDesc = $_POST["bookDesc"] ?? "";
    $bookAuthor = $_POST["bookAuthor"] ?? "";

    if(empty($bookTitle)){
      $errors[] = "Titre obligatoire";
    }
    if(empty($bookDesc)){
      $errors[] = "Description obligatoire";
    }
    if(empty($bookAuthor)){
      $errors[] = "Auteur obligatoire";
    }

    try {
      $pdo = dbLog();
      $request = $pdo->prepare("INSERT INTO books(title, description, author) VALUES (?,?,?)");
      $request->execute([$bookTitle, $bookDesc, $bookAuthor]);
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
    <title>MyBook - Ajout</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
</head>
<body>
  <main>
    <form method="post">
      <label for="bookTitle" class="form-label mt-4">Titre du livre</label>
      <input type="text" name="bookTitle" class="form-control" id="bookTitle" aria-describedby="emailHelp" placeholder="Titre du livre">
      <label for="bookDesc">Description du livre</label>
      <textarea name="bookDesc" id="bookDesc" class="form-control" placeholder="Descrption du livre"></textarea>
      <label for="bookAuthor">Auteur du livre</label>
      <input type="text" id="bookAuthor" name="bookAuthor" class="form-control" placeholder="Auteur du livre">
      <input type="submit" value="Ajouter" class="btn btn-primary">
    </form>
  </main>
</body>
</html>
