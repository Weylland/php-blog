<?php
session_start();

if(isset($_SESSION['userId'])) {
    
    if(isset($_POST['send'])) {

        $header = $article = "";
        $articledate = date('Y-m-d H:i:s');
        $uid = $_SESSION['userId'];

        function securisation($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = strip_tags($data);
            return $data;
        }

        $header = securisation($_POST['articleheader']);
        $article = securisation($_POST['textarticle']);

        if(empty($header) || empty($article)) {
            header("Location: ../addarticle.php?error=emptyfields&header=".$header."&article=".$article);
            exit();
        } else {
            try {
                require 'dbh.inc.php';

                $sql = "
                    INSERT INTO articles (id_user, article_date, article_title, article_text)
                    VALUE (:uid, :adate, :atitle, :atext)
                ";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':uid', $uid);
                $stmt->bindParam(':adate', $articledate );
                $stmt->bindParam(':atitle', $header);
                $stmt->bindParam(':atext', $article);
                $stmt->execute();
                header("Location: ../articleslist.php?addarticle=success");
                exit();

            } catch(PDOException $e) {
                header("Location: ../addarticle.php?error=sqlerror");
                exit();
            }
        }

    } else {
        header("Location: ../addarticle.php");
        exit();
    }
} else {
    header("Location: ../addarticle.php?error=notconnected");
    exit();
}
