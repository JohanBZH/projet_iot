<?php 
    session_start();

    include '../Backend/db_conn.php';

//  Search into the db the informations of the user currently connected

    $stmt = $db->prepare("SELECT * FROM App_user WHERE Login = :llogin");
    $stmt->bindParam(':llogin',$_SESSION['login']);
    $stmt->execute();

    // checks password is not null
    if (empty($_POST['lastPwd']) || empty($_POST['newPwd']) || empty($_POST['newPwd2'])){ 
        $msg = "Don't forget the password.";
        header("Location: ../Frontend/error.php?msg=".$msg); 
        exit();
    }

    if ($password !== $passwordcheck) { // checks both passwords are the same
        $msg = "Passwords don't match.";
        header("Location: ../Frontend/error.php?msg=".$msg); 
        exit();
    } 

?>