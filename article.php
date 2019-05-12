<?php
    require 'header.php';
    if(isset($_GET['id']) AND is_numeric($_GET['id'])) {
        $id = strip_tags($_GET['id']);
        try {
            require "includes/dbh.inc.php";
            $sqlarticles = "
                SELECT users.username, art.article_text, art.article_date, art.article_title
                FROM users 
                INNER JOIN articles AS art
                ON users.id_user = art.id_user 
                WHERE art.id_article = ?
            ";
            $stmt = $conn->prepare($sqlarticles);
            $stmt->execute(array($id));
            if($stmt->rowCount() != 0){
                $articles = $stmt->fetchAll();
            } else {
                header("Location: ../articleslist.php");
                exit();
            }
            
        } catch(PDOException $e) {
            header("Location: ../articleslist.php?error=sqlerror");
            exit();
        }
    } else {
        header("Location: ../articleslist.php");
        exit();
    }
?>

    <main  class="container">
        <div>
            <?php foreach($articles as $article): ?>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h1 class="h1 text-center m-5"><?= $article['article_title']; ?></h1>
                        <p class="lead"><?= $article['article_text']; ?></p>
                        <hr class="my-4">
                        <p class="blockquote-footer">Poster le <?= $article['article_date']; ?> par <?= $article['username']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

<?php
    require "footer.php";
?>