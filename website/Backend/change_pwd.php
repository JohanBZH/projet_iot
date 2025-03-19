<?php 
    session_start();

    include '../Backend/db_conn.php';

    //  Search into the db the informations of the user currently connected

    $stmt = $db->prepare("SELECT * FROM App_user WHERE Login = :llogin");
    $stmt->bindParam(':llogin',$_SESSION['login']);
    $stmt->execute();

    // checks password is not null

    if (empty($_POST['lastPwd']) || empty($_POST['newPwd']) || empty($_POST['newPwd2'])){ 
        $msg = "Don't forget the passwords.";
        header("Location: ../Frontend/error.php?msg=".$msg);
        exit();
    }

    $oldPwd = $_POST['lastPwd'];
    $newPwd1 = $_POST['newPwd'];
    $newPwd2 = $_POST['newPwd2'];

    foreach ($stmt as $user) {
        if ($user["Password"] != null) {
            if(!password_verify($oldPwd, $user["Password"])){
                $msg = "Votre ancien mot de passe est incorrect.";
                header("Location: ../Frontend/error.php?msg=".$msg); 
                exit();
            }
        }
    }

    // checks both passwords are the same

    if ($newPwd1 !== $newPwd2) { 
        $msg = "Passwords don't match.";
        header("Location: ../Frontend/error.php?msg=".$msg); 
        exit();
    } 
    
    // Updating the password
    
    $newPassword = password_hash($newPwd1, PASSWORD_DEFAULT);
    $stmt = $db->prepare("UPDATE App_user SET Password = :pwd WHERE Login = :llogin");
    $stmt->bindParam(':llogin',$_SESSION['login']);
    $stmt->bindParam(':pwd',$newPassword);
    $stmt->execute();

    header("Location: ../Frontend/profile.php");
?>