<?php
// PAGE TO SIGN UP

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

// checks password is not null
    if (empty($_POST['password'])){ 
        $msg = "Don't forget the password.";
        header("Location: error.php?msg=".$msg); 
        exit();
    }

// checks the table for an existing identical email address
    $stmt = $db->prepare("SELECT * FROM App_user WHERE Login = :llogin");
    $stmt->bindParam(':llogin',$email);
    $stmt->execute();

    foreach ($stmt as $user) {
        if ($user["Password"] != null) {
// /!\ password_verify will only work if you set set the max var char length to > 200
            if (password_verify($password, $user["Password"])){
                header("Location: data.php?email=".$email . "&msg=".$msg); 
                exit();
            } 
            else {
                $msg = "Wrong email and password combination";
                header("Location: error.php?msg=".$msg); 
                exit();
            }
        }
    }

    $msg = "Email not found";
    header("Location: error.php?msg=".$msg);
    exit();

// connecting to your account allows you access to the graph and data table
    if ($msg == "") {
        // // header("Location: data.php?email=".$email . "&msg=".$msg); 
        // echo "ça marche";
        // echo $stmt;
        // echo $email;
        // exit();
    }

    if ($msg !== "") {
        // header("Location: error.php?msg=".$msg); 
    }
