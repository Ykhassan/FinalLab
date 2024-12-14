<?php 

class todo {
    private $id;
    private $taskName;
    private $date;
    private $done;
    private $dbConnection;
    private $dbTable = 'tasks';

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Getter and Setter for taskName
    public function getTaskName() {
        return $this->taskName;
    }

    public function setTaskName($taskName) {
        $this->taskName = $taskName;
    }

    // Getter and Setter for date
    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    // Getter and Setter for done
    public function getDone() {
        return $this->done;
    }

    public function setDone($done) {
        $this->done = $done;
    }

    public function create() {
        $sqlQuery = "INSERT INTO " . $this->dbTable . "(task, date_added, done) VALUES (:task_value, :date_value, DEFAULT)";
        $stmt = $this->dbConnection->prepare($sqlQuery);
        $this->date = date("Y-m-d H:i:s", strtotime(""));
        $stmt->bindParam("task_value", $this->taskName, PDO::PARAM_STR);
        $stmt->bindParam("date_value", $this->date, PDO::PARAM_STR);
        try {
            $stmt->execute();
            if($stmt->rowCount() === 1){
                $results = $this->displayNew($this->dbConnection->lastInsertId());
                echo "New record added"; 
                return $results;
            } else{
                echo "No change";
            }

        } catch (PDOException $ex){
            echo "Creation failed: " . $ex->getMessage();
        }

    }

    public function displayTaskList(){
        $sqlQuery = "SELECT * FROM " . $this->dbTable;
        $stmt = $this->dbConnection->prepare($sqlQuery);
        try {
            // execute query directly
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $results; 
        }catch (PDOException $ex){
            echo "Selection failed: " . $ex->getMessage();
        }

    }

    public function displayNew($id) {
        $sqlQuery = "SELECT * FROM " . $this->dbTable . " WHERE id = " . $id;
        $stmt = $this->dbConnection->prepare($sqlQuery);
        try {
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            return $results;
        
    } catch (PDOException $ex){
        echo "Selection failed: " . $ex->getMessage();
    }
    }

    public function updateTask($id, $taskName, $taskDate, $done) {
        $sqlQuery = "UPDATE " . $this->dbTable . " SET task = :task_value, date_added = :date_value, done = :done_value where id = :id_value";
        $stmt = $this->dbConnection->prepare($sqlQuery);
        $stmt->bindParam('task_value',$taskName);
        $stmt->bindParam('date_value',$taskDate);
        $stmt->bindParam('done_value',$done);
        $stmt->bindParam('id_value',$id);
        try {
            $stmt->execute(); 
            if($stmt->rowCount() === 1){
                $results = $this->displayNew($id);
                echo " Record Updated"; 
                return $results;
            } else{
                echo "No change" .$stmt->rowCount();
            }

        } catch (PDOException $ex){
            echo "Update failed: " . $ex->getMessage();
        }
    }

    public function deleteTask($id){
        $sqlQuery = " DELETE FROM " . $this->dbTable . " where id=:id_value";
        $stmt = $this->dbConnection->prepare($sqlQuery);
        $stmt->bindParam('id_value', $id);
        try {
            $stmt->execute();
            if($stmt->rowCount() === 1) {
                return $stmt->rowCount();
                echo "deleted sucssfully";
            } else{
                echo "Issue with deletion";
            }

        } catch (PDOException $ex){
            echo "Deletion failed: " . $ex->getMessage();
        }
    }
}