<?php
if(isset($_POST['login-submit'])) {
    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if(empty($mailuid) || empty($password) ) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        try {
            $sql = "SELECT * FROM users WHERE username=:uid OR user_email=:email";
            $request = $conn->prepare($sql);
            $request->bindParam(':uid', $mailuid);
            $request->bindParam(':email', $mailuid);
            $request->execute();

            $user = $request->fetch(PDO::FETCH_OBJ);

            if($request->fetchColumn()){
                header("Location: ../index.php?error=nouser");
                exit();
            } else {

                $passwordcheck = password_verify($password, $user->password);

                if($passwordcheck == false) {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                } else if($passwordcheck == true) {
                    session_start();
                    $_SESSION['userId'] = $user->id_user;
                    $_SESSION['userUid'] = $user->username;
                    header("Location: ../index.php?success=success");
                    exit();
                }
            }
        } catch (PDOException $e) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
    }

} else {
    header("Location: ../index.php");
    exit();
}
