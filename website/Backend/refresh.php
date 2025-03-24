<?php
require_once '../Backend/db_conn.php';

// Run the refresh action and exit so only the needed data is sent
if (isset($_GET['action']) && $_GET['action'] === 'refresh') {
    refresh($db);
    exit;
}

// Get the last data, ship it in a JSON file
function refresh($db){
    $lastGet = getLastInsert($db);

    $refreshedData = [
        'temperature' => $lastGet[0]['Temperature_value'],
        'humidity' => $lastGet[0]['Humidity_value'],
        'time' => $lastGet[0]['Time_stamp'] 
    ];

    // Define the header so the browser knows it's JSON content
    header('Content-Type: application/json');
    // Encode the array in JSON format, echo 
    echo json_encode($refreshedData);
}

function getLastInsert($db){
    $query = "SELECT * FROM Data ORDER BY id_data DESC LIMIT 1";
    $last = $db->query($query);
    return $last->fetchAll();
}
?>