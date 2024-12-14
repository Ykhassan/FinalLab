<?php
chdir(__DIR__);
// Validate method type
if ($_SERVER['REQUEST_METHOD'] !== 'PUT'){
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
header('Access-Control-Allow-Methods: PUT');

require_once '../db/database.php';
require_once '../models/todo.php';

$dataBase = new database();
$connection = $dataBase->connect();

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['id']) || !isset($data['task']) || !isset($data['date_added']) || !isset($data['done'])){
    echo json_encode (array('message' => 'Missing details makesure you include all tasks data id, task, date, done '));
    return;
}


$todo = new todo($connection);
$results = $todo->updateTask($data['id'], $data['task'], $data['date_added'], $data['done']);

if ($results) {
    echo json_encode(array('message' => 'Updated sucssfully get', 'task' => $results));
    return;
} else {
    echo json_encode(array('message' => 'Error updating tasks'));
}


