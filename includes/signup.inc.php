<?php
if(isset($_POST['signup-submit'])) {

    require 'dbh.inc.php';

    $username = $email = $password = $passwordRepeat = "";

    function securisation($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        return $data;
    }

    $username = securisation($_POST['uid']);
    $email = securisation($_POST['mail']);
    $password = securisation($_POST['pwd']);
    $passwordRepeat = securisation($_POST['pwd-repeat']);


    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=".$username);
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&mail=".$email);
        exit();
    } elseif($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
        exit();
    } elseif(!preg_match("/^\S{8,}$/", $password)) {
        header("Location: ../signup.php?error=passwordtoshort&uid=".$username."&mail=".$email);
        exit();
    } else {
        try {
            $sqlUidCheck = "SELECT COUNT(*) FROM users WHERE username=:uid OR user_email=:mail";
            $request = $conn->prepare($sqlUidCheck);
            $request->bindParam(':uid', $username);
            $request->bindParam(':mail', $email);
            $request->execute();

            if($request->fetchColumn()) {
                header("Location: ../signup.php?error=userormailtaken&mail=".$email);
                exit();
            } else {
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                $sqlCreateNewUser = "
                    INSERT INTO users (username, user_email, password)
                    VALUES (:uid, :mail, :pwd)
                ";
                $request = $conn->prepare($sqlCreateNewUser);
                $request->bindParam(':uid', $username);
                $request->bindParam(':mail', $email);
                $request->bindParam(':pwd', $hashedPwd);
                $request->execute();
                header("Location: ../index.php?signup=success");
                exit();
            }
        } catch (PDOException $e) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
    }
} else {
    header("Location: ../signup.php");
    exit();
}