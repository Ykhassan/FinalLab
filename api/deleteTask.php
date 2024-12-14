<?php
chdir(__DIR__);
// Validate method type
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE'){
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
header('Access-Control-Allow-Methods: DELETE');

require_once '../db/database.php';
require_once '../models/todo.php';

$dataBase = new database();
$connection = $dataBase->connect();

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['id'])){
    echo json_encode (array('message' => 'Missing Id'));
    return;
}


$todo = new todo($connection);
$results = $todo->deleteTask($data['id']);

if ($results) {
    echo json_encode(array('message' => 'Deleted sucssfully'));
    return;
} else {
    echo json_encode(array('message' => 'Error deleting tasks'));
}


