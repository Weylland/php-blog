<?php
    require "header.php";
    require "includes/dbh.inc.php";
    $sqlarticles = "
        SELECT users.username, art.article_text, art.article_date, art.article_title, art.id_article
        FROM users 
        INNER JOIN articles AS art
        ON users.id_user = art.id_user ";
    $stmt = $conn->prepare($sqlarticles);
    $stmt->execute();
    $articles = $stmt->fetchAll();
?>

    <main>
        <div class="container">
            <?php foreach($articles as $article): ?>
                <div class="jumbotron m-5">
                    <h1 class="display-4"><?= $article['article_title']; ?></h1>
                    <p class="lead"><?= $article['article_text']; ?></p>
                    <hr class="my-4">
                    <p>Poster le <?= $article['article_date']; ?> par <?= $article['username']; ?></p>
                    <a class="btn btn-primary btn-lg" href="article.php?id=<?= $article['id_article']; ?>" role="button">Voir l'article</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    
<?php
    require "footer.php";
?>