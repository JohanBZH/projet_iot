<?php
// PAGE TO SIGN IN
session_start();

include '../Backend/db_conn.php';

$msg = "";

// check email address

// check address is not null when sent
    if ($_SERVER["REQUEST_METHOD"] != "POST"){ 
        $msg = "Error.";
        header("Location: ../Frontend/error.php?msg=".$msg); 
        exit();
    }
    
    if (empty($_POST['email'])) { 
        $msg = "Don't forget the email.";
        header("Location: ../Frontend/error.php?msg=".$msg); 
        exit();
    }

    $email_ToFilter = $_POST['email'];
    $email = filter_var($email_ToFilter, FILTER_VALIDATE_EMAIL);

// check if email address is valid
    if($email == false) { 
        $msg = "Invalid email address.";
        header("Location: ../Frontend/error.php?msg=".$msg); 
        exit();
    }

    $password = $_POST['password'];

// check password is not null
    if (empty($_POST['password'])){ 
        $msg = "Don't forget the password.";
        header("Location: ../Frontend/error.php?msg=".$msg); 
        exit();
    }

// check the table for an existing identical email address
    $stmt = $db->prepare("SELECT * FROM App_user WHERE Login = :llogin");
    $stmt->bindParam(':llogin',$email);
    $stmt->execute();

    foreach ($stmt as $user) {
        if ($user["Password"] != null) {
// /!\ password_verify will only work if you set the max var char length to > 200 in your database

// check the password in the database and allow access if they match
            if (password_verify($password, $user["Password"])){
                $_SESSION['login'] = $user['Login'];
                $_SESSION['loggedIn'] = true;
                header("Location: ../Frontend/data.php?email=".$email . "&msg=".$msg); 
                exit();
            } 
            else {
                $msg = "Wrong email and password combination";
                header("Location: ../Frontend/error.php?msg=".$msg); 
                exit();
            }
        }
    }

    $msg = "Email not found";
    header("Location: ../Frontend/error.php?msg=".$msg);
    exit();

