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
        <section class="sectionBooks" name="sectionBooks" id="sectionBooks">
            <div class="booksContainer" name="booksContainer" id="booksContainer">
                <div class="imgContainer">
                    <img class="imgBooks" src="img/Meinkampf.jpg" alt="">
                </div>
                <h3 classe="nameBook">Titre du livre</h3>
                <span>Nom de l'auteur</span>
                <a href="book.php" class=>Voir le produit</a>
            </div>
            <div class="booksContainer" name="booksContainer" id="booksContainer">
                <div class="imgContainer">
                    <img class="imgBooks" src="img/Meinkampf.jpg" alt="">
                </div>
                <h3 classe="nameBook">Titre du livre</h3>
                <span>Nom de l'auteur</span>
                <a href="book.php" class=>Voir le produit</a>
            </div>
            <div class="booksContainer" name="booksContainer" id="booksContainer">
                <div class="imgContainer">
                    <img class="imgBooks" src="img/Meinkampf.jpg" alt="">
                </div>
                <h3 classe="nameBook">Titre du livre</h3>
                <span>Nom de l'auteur</span>
                <a href="book.php" class=>Voir le produit</a>
            </div>
        </section>
    </main>
    <footer>
        <?php include 'include/footer.php' ?>
    </footer>
</body>
</html>