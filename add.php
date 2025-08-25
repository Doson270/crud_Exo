<?php
require_once "database/database.php";
$errors = [];
$success = "";

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

            if ($request->execute([$bookTitle, $bookDesc, $bookAuthor])) {
                $success = "Livre ajouté avec succès ✅";
            } else {
                $errors[] = implode(" | ", $request->errorInfo());
            }

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
  <main class="container mt-5">
    <h1>Ajouter un livre</h1>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
          <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="alert alert-success">
        <?= htmlspecialchars($success) ?>
      </div>
    <?php endif; ?>

    <form method="post">
      <label for="bookTitle" class="form-label mt-4">Titre du livre</label>
      <input type="text" name="bookTitle" class="form-control" id="bookTitle" placeholder="Titre du livre">

      <label for="bookDesc" class="form-label mt-4">Description du livre</label>
      <textarea name="bookDesc" id="bookDesc" class="form-control" placeholder="Description du livre"></textarea>

      <label for="bookAuthor" class="form-label mt-4">Auteur du livre</label>
      <input type="text" id="bookAuthor" name="bookAuthor" class="form-control" placeholder="Auteur du livre">

      <input type="submit" value="Ajouter" class="btn btn-primary mt-3">
    </form>
  </main>
  <footer>
    <?php include "include/footer.php" ?>
  </footer>
</body>
</html>
