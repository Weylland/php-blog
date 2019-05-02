<?php
    require "header.php";
?>

    <main class="container">
        <h1 class="text-center m-3" >Signup</h1>
        <?php
            if(isset($_GET['error'])) {
                if($_GET['error'] == "emptyfields"){
                    echo '<p class="alert alert-danger text-center">Vous devez remplir tous les champs!</p>';
                } elseif($_GET['error'] == "invalidmailuid") {
                    echo '<p class="alert alert-danger text-center">Le nom d\'utilisateur ou l\'email est invalide!</p>';
                } elseif($_GET['error'] == "invalidmail") {
                    echo '<p class="alert alert-danger text-center">l\'email est invalide!</p>';
                } elseif($_GET['error'] == "invaliduid") {
                    echo '<p class="alert alert-danger text-center">Le nom d\'utilisateur est invalide!</p>';
                } elseif($_GET['error'] == "passwordcheck") {
                    echo '<p class="alert alert-danger text-center">Le mot de passe est différent!</p>';
                } elseif($_GET['error'] == "passwordtoshort") {
                    echo '<p class="alert alert-danger text-center">Le mot de passe doit faire au moins 8 caractères!</p>';
                } elseif($_GET['error'] == "userormailtaken") {
                    echo '<p class="alert alert-danger text-center">Le nom d\'utilisateur ou l\'email est déjà pris!</p>';
                } elseif($_GET['error'] == "sqlerror") {
                    echo '<p class="alert alert-danger text-center">Le site rencontre quelques difficultés veuillez réessayer ultérieurement!</p>';
                }
            }
            ?>
        <form action="includes/signup.inc.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="uid" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="mail" placeholder="E-mail">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pwd" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pwd-repeat" placeholder="Reapeat password">
            </div>
            <button type="submit" class="form-control" name="signup-submit">Signup</button>
        </form>
    </main>

<?php
    require "footer.php";
?>