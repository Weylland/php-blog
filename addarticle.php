<?php 
    require 'header.php';
    if(!isset($_SESSION['userId'])) {
        header("Location: ../index.php?error=notconnected");
        exit();
    }
?> 

    <main>
        <div class="container">
            <div>
            <form action="includes/addarticle.inc.php" method="POST">
                <input type="text" name="articleheader">
                <textarea name="textarticle" cols="30" rows="10"></textarea>
                <input type="submit" name="send" Value="Envoyer">
            </form>        
            </div>
        </div>  
    </main>

<?php 
    require 'footer.php'
?> 