<?php

function insertUser($login1, $password1, $db){

    echo $login1;
    echo $password1;

    $insertStmt = $db->prepare("INSERT INTO App_user (Login, Password) VALUES (:llogin, :ppassword)");
    
    $insertStmt->bindParam('llogin',$login1);
    $insertStmt->bindParam('ppassword',$password1);
    $insertStmt->execute();

}

function controlUser(){

}

function insertData(){
    
}

function requestData(){

}

?>