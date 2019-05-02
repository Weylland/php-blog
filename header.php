<?php
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="src/css/bootstrap.css">
    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-xl navbar-light bg-light">
            <a href="" class="navbar-brand">
                <img src="src/img/logo.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="index.php" class="nav-link">Acceuil</a></li>
                    <li class="nav-item"><a href="articlesList.php" class="nav-link">Articles</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">About me</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
                </ul>
                <?php
                    if(isset($_SESSION['userId'])) {
                        echo '
                            <div class="btn-group mr-5">
                                <button class="btn btn btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ';
                ?>
                <?= $_SESSION['userUid']; ?>
                <?php
                        echo '
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Ajouter un article</a>
                                </div>
                            </div>
                        ';
                    };
                ?>
                <?php 
                    if(isset($_SESSION['userId'])){
                        echo '            
                            <form action="includes/logout.inc.php" method="POST" class="form-inline my-2 my-md-0">
                                <button type="submit" name="logout-submit" class="btn btn-outline-success my-2 my-sm-0">Logout</button>
                            </form>
                        ';
                    } else {
                        echo '            
                            <div class="form-inline">
                                <form action="includes/login.inc.php" method="POST" class="form-inline my-2 my-md-0">
                                    <input type="text" name="mailuid" placeholder="Username/E-mail..." class="form-control mr-sm-2">
                                    <input type="password" name="pwd" placeholder="Password..." class="form-control mr-sm-2">
                                    <button type="submit" name="login-submit" class="btn btn-outline-success my-2 my-sm-0">Login</button>
                                </form>
                                <form action="signup.php" class="ml-2">
                                    <button class="btn btn-outline-success my-2 my-sm-0 ">Signup</button>
                                </form>
                            </div>
                        ';
                    }
                ?>

            </div>
        </nav>
    </header>