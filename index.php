<?php
    require "header.php";
?>

    <main>
        <div class="container-fluid">
        <?php
            if(isset($_GET['signup'])) {
                if($_GET['signup'] == "success"){
                    echo '        
                    <div class="alert alert-primary alert-dismissible fade show m-5">
                        <p class="text-center">vous vous êtes enregistré avec succès!</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                }
            }
            if(isset($_SESSION['userId'])){
                 echo '            
                    <div class="row justify-content-center m-3 ">
                        <div class="col-2 ">
                            <p>You are logged in!</p>
                        </div>
                    </div>
                ';
            } else {
                echo '            
                    <div class="row justify-content-center m-3 ">
                        <div class="col-2 ">
                            <p>You are logged out!</p>
                        </div>
                    </div>
                ';
            }
        ?>
        </div>

    </main>

<?php
    require "footer.php";
?>