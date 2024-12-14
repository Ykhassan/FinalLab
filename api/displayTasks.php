<?php
chdir(__DIR__);
// Validate method type
if ($_SERVER['REQUEST_METHOD'] !== 'GET'){
    header('Allow: GET');
    http_response_code(405);
    echo json_encode(array('message' => 'Method not allowed'));
    return;
} 


// Accept request from any origin
header('Access-Control-Allow-origin: *');
// Accept only json data types
header('Content-Type: application/json');
// Allow only POST method
header('Access-Control-Allow-Methods: GET');

require_once '../db/database.php';
require_once '../models/todo.php';

$dataBase = new database();
$connection = $dataBase->connect();


$todo = new todo($connection);
$results = $todo->displayTaskList();

if ($results) {
    echo json_encode(array('message' => 'sucssfull get', 'task' => $results));
    return;
} else {
    echo json_encode(array('message' => 'Error getting tasks'));
}


