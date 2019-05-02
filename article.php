<?php 
    if(isset($_GET['id']) AND is_numeric($_GET['id'])) {
        $id = strip_tags($_GET['id']);
        try {
            require "includes/dbh.inc.php";
            $sqlarticles = "
                SELECT users.username, art.article_text, art.article_date, art.article_title
                FROM users 
                INNER JOIN articles AS art
                ON users.id_user = art.id_user 
                WHERE art.id_user = ?
            ";
            $stmt = $conn->prepare($sqlarticles);
            $stmt->execute(array($id));
            if($stmt->rowCount() == 1){
                $articles = $stmt->fetchAll();
                return $articles;
            } else {
                header("Location: ../articlesList.php?error=sqlerror");
                exit();
            }
            
        } catch(PDOException $e) {
            header("Location: ../articlesList.php?error=sqlerror");
            exit();
        }
    } else {
        header("Location: ../articlesList.php");
        exit();
    }
?>