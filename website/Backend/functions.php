<?php

function insertUser($login1, $password1, $db){

    $insertStmt = $db->prepare("INSERT INTO App_user (Login, Password) VALUES (:llogin, :ppassword)");
    
    $insertStmt->bindParam('llogin',$login1);
    $insertStmt->bindParam('ppassword',$password1);
    $insertStmt->execute();

}

function controlUser($login1, $password1, $db){


}

function insertData($time_val, $temperature_val, $humidity_val, $db){

    $insertStmt = $db->prepare("INSERT INTO Data (Time_stamp, Temperature_value, Humidity_value) VALUES (:time_val, :temperature_val, :humidity_val)");
    
    $insertStmt->bindParam('time_val',$time_val);
    $insertStmt->bindParam('temperature_val',$temperature_val);
    $insertStmt->bindParam('humidity_val',$humidity_val);
    $insertStmt->execute();
    
}

function requestData(){

}

?>