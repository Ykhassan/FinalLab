<?php
function dbConnection($host, $port, $dbName, $userName, $password){
    $dsn = "mysql:host=".$host.";port=".$port.";dbname=". $dbName;
    try {
        $connection = new PDO($dsn, $userName, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Connection good';
        return $connection;
    } catch (PDOException $ex) {
        echo "Connection failed: ". $ex->getMessage();
    }
}

function select($tableName) {
    $sqlQuery = "SELECT * FROM $tableName";
    $stmt = $GLOBALS["connection"]->prepare($sqlQuery);
    if($stmt){
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}

function insertTask($task, $date){
    $sqlQuery = "INSERT INTO tasks(task, date_added, done) VALUES (:task_value, :date_value, DEFAULT)";
    $date = date("Y-m-d H:i:s", strtotime($date));
    $stmt = $GLOBALS["connection"]->prepare($sqlQuery);
    try {
        if($stmt){
            $stmt->bindParam("task_value", $task, PDO::PARAM_STR);
            $stmt->bindParam("date_value", $date, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0){
                return "New record added";
            } else{
                return "Nothing changed";
            }
        }
    } catch (PDOException $ex){
        return "Insert failed: " . $ex->getMessage();
    }

}

function deletTask($taskId){
    $sqlQuery = "DELETE FROM tasks WHERE id = :id_value";
    $stmt = $GLOBALS['connection']->prepare($sqlQuery);
    try {
        if($stmt) {
            $stmt->bindParam('id_value', $taskId, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return "Deleted record";
            } else {
                return "Nothing changed";
            }
        }
    } catch (PDOException $ex){
        return "Delete failed: " . $ex->getMessage();
    }


}