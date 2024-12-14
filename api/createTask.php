<?php
chdir(__DIR__);
// Validate method type
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Allow: POST');
    http_response_code(405);
    echo json_encode(array('message' => 'Method not allowed'));
    return;
} 


// Accept request from any origin
header('Access-Control-Allow-origin: *');
// Accept only json data types
header('Content-Type: application/json');
// Allow only POST method
header('Access-Control-Allow-Methods: POST');

require_once '../db/database.php';
require_once '../models/todo.php';

$dataBase = new database();
$connection = $dataBase->connect();

// Receive the request
$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['task'])){
    echo json_encode (array('message' => 'Task param not found, make sure its lower cased'));
    return;
}

$todo = new todo($connection);
$todo->setTaskName('Create React App using Vite');
$results = $todo->create();

echo json_encode($data['task']);

if ($results) {
    echo json_encode(array('message' => 'Task added', 'task' => $results));
    return;
} else {
    echo json_encode(array('message' => 'Error createing task'));
}


