<?php
// PAGE TO SIGN IN

include '../Backend/db_conn.php';

$msg = "";

// checks email address

// checks address is not null when sent
    if ($_SERVER["REQUEST_METHOD"] != "POST"){ 
        $msg = "Error.";
        header("Location: error.php?msg=".$msg); 
        exit();
    }
    
    if (empty($_POST['email'])) { 
        $msg = "Don't forget the email.";
        header("Location: error.php?msg=".$msg); 
        exit();
    }

    $email_ToFilter = $_POST['email'];
    $email = filter_var($email_ToFilter, FILTER_VALIDATE_EMAIL);

// checks if email address is valid
    if($email == false) { 
        $msg = "Invalid email address.";
        header("Location: error.php?msg=".$msg); 
        exit();
    }

    $password = $_POST['password'];
    $passwordcheck = $_POST['passwordcheck'];

// checks password is not null
    if (empty($_POST['password']) || empty($_POST['passwordcheck'])){ 
        $msg = "Don't forget the password.";
        header("Location: error.php?msg=".$msg); 
        exit();
    }

    if ($password !== $passwordcheck) { // checks both passwords are the same
        $msg = "Passwords don't match.";
        header("Location: error.php?msg=".$msg); 
        exit();
    } 

// checks the table for an existing identical email address
    $stmt = $db->prepare("SELECT COUNT(*) AS cnt FROM App_user WHERE Login = :llogin");
    $stmt->bindParam(':llogin',$email);
    $stmt->execute();
    $row = $stmt->fetch();

    if ((int)$row["cnt"] != 0){
        $msg = "Account already exists. Please sign in instead.";
        header("Location: error.php?msg=".$msg); 
        exit();
    } 

// inserts new user into table
    echo "Valid email address.";
    $stmt = $db->prepare("INSERT INTO App_user (Login, Password) VALUES (:llogin, :ppassword)");
    $stmt->bindParam(':llogin',$email);
    $stmt->bindParam(':ppassword',password_hash($password, PASSWORD_DEFAULT));
    $stmt->execute();

// connecting to your account allows you access to the graph and data table
    if ($msg == "") {
        // header("Location: data.php?email=".$email . "&msg=".$msg); 
        echo "ça marche";
        echo $stmt;
        echo $email;
        exit();
    }

    if ($msg !== "") {
        header("Location: error.php?msg=".$msg); 
    }