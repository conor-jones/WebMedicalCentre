<?php
class DoctorTableGateway {
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
    }
    
    public function getDoctors() {
        $sqlQuery = "SELECT * FROM managers";
        
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Could not retrieve doctors");
        }
        
        return $statement;
    }
    
    
}
