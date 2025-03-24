<?php 
    session_start();

    include '../Backend/db_conn.php';
// Check user gave the right instruction
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
// Delete this user's row from the database
    $stmt = $db->prepare("DELETE FROM App_user WHERE Login = :llogin");
    $stmt->bindParam(':llogin',$_SESSION['login']);
    $stmt->execute();

    session_unset();
    $msg ="Votre compte a été supprimé";
    header("Location: ../Frontend/error.php?msg=".$msg);
?>