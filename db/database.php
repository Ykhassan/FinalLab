<?php
require_once '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class database {
    private $dbHost;
    private $dbPort;
    private $dbName;
    private $dbUser;
    private $dbPassword;
    private $dbConnection;

    public function __construct()
    {
        $this->dbHost = $_ENV['DB_HOST'];
        $this->dbPort = $_ENV['LOCAL_MACHINE_PORT'];
        $this->dbUser = $_ENV['DB_USER'];
        $this->dbName = $_ENV['DB_NAME'];
        $this->dbPassword = $_ENV['DB_ROOT_PASSWORD'];

        if ( !$this->dbHost || !$this->dbPort || !$this->dbUser || !$this->dbPassword )
        {
            die("Missing credentials");
        }
        
    }

    function connect(){
        $dsn = "mysql:host" . $this->dbHost . ";port=" . $this->dbPort . ";dbname=" .$this->dbName;
        try {
            $this->dbConnection = new PDO($dsn, $this->dbUser, $this->dbPassword);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->dbConnection;

        } catch (PDOException $ex){
            return "Connection failed: ". $ex->getMessage();
        }

    }
}
