<?php
require_once "database/database.php";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bookTitle = trim($_POST["bookTitle"] ?? "");
    $bookDesc = trim($_POST["bookDesc"] ?? "");
    $bookAuthor = trim($_POST["bookAuthor"] ?? "");

    if (empty($bookTitle)) {
        $errors[] = "Titre obligatoire";
    }
    if (empty($bookDesc)) {
        $errors[] = "Description obligatoire";
    }
    if (empty($bookAuthor)) {
        $errors[] = "Auteur obligatoire";
    }

    if (empty($errors)) {
      try {
        $pdo = dbLog();
        $request = $pdo->prepare("INSERT INTO books (title, description, author) VALUES (?, ?, ?)");
        $request->execute([$bookTitle, $bookDesc, $bookAuthor]);
      } catch (PDOException $e) {
        $errors[] = "Erreur PDO : " . $e->getMessage();
      }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBook - Ajout</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/include.css">
</head>
<body>
  <header>
    <?php include "include/header.php" ?>
  </header>
  <main>
  <section class="sectionForm" name="sectionForm" id="sectionForm">
    <h1>Ajouter un livre</h1>
    <?php if (!empty($errors)) { ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error) { ?>
          <?= $error ?>
        <?php } ?>
      </div>
    <?php } ?>

    <form method="post">
      <input type="text" name="bookTitle" class="form-control" id="bookTitle" placeholder="Titre du livre">
      <textarea name="bookDesc" id="bookDesc" class="form-control" placeholder="Description du livre"></textarea>
      <input type="text" id="bookAuthor" name="bookAuthor" class="form-control" placeholder="Auteur du livre">
      <input type="submit" value="Ajouter" class="btn btn-primary mt-3">
    </form>
        </section>
  </main>
  <footer>
    <?php include "include/footer.php" ?>
  </footer>
</body>
</html>
