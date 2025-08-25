<?php
  require_once "database/database.php";
  $pdo = dbLog();
  $request = $pdo->prepare("SELECT * FROM books");
  $request->execute();
  $books = $request->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBooks - Nos livres</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/include.css">
</head>
<body>
    <header>
    <?php include 'include/header.php' ?>
    </header>
    <main>
        <section class="sectionBooks" name="sectionBooks" id="sectionBooks">
          <?php foreach ($books as $book) { ?>
            <div class="booksContainer" name="booksContainer" id="booksContainer">
              <div class="imgContainer">
                <img class="imgBooks" src="img/Meinkampf.jpg" alt="">
              </div>
              <h3 classe="nameBook"><?= $book["title"] ?></h3>
              <span>Par <?= $book["author"]?></span>
              <a href="book.php?id=<?= $book["id"] ?>" class=>Voir le produit</a>
            </div>
          <?php } ?>
        </section>
    </main>
    <footer>
        <?php include 'include/footer.php' ?>
    </footer>
</body>
</html>
