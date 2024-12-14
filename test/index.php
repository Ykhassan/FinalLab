

<?php
require_once './dataBaseConnection.php';
$connection = dbConnection("localhost", 3306, 'todo_db', 'root', 'example');
// echo insertTask("Allawi", date("Y-m-d"));
echo deletTask(2);
var_dump(select('tasks'));


