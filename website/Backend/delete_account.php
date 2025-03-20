<?php 
    session_start();

    include '../Backend/db_conn.php';

    if (!empty($_POST['confirm'])){
        if($_POST['confirm'] != 'confirmer'){
            $msg = "You didn't type 'confirmer'";
            header("Location: ../Frontend/error.php?msg=".$msg);
            exit();
        }
    }
    else{
        $msg = "Don't forget to type 'confirmer'";
        header("Location: ../Frontend/error.php?msg=".$msg);
        exit();
    }

    $stmt = $db->prepare("DELETE FROM App_user WHERE Login = :llogin");
    $stmt->bindParam(':llogin',$_SESSION['login']);
    $stmt->execute();

    session_unset();
    $msg ="Votre compte a été supprimé";
    header("Location: ../Frontend/error.php?msg=".$msg);
?>