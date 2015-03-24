<?php
class DoctorTableGateway {
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
    }
    
    public function getDoctors() {
        //execute a query to get all patients
        $sqlQuery = " SELECT * FROM doctors";
        
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();
        
        if(!$status) {
            die("Could not retrieve doctors");
        }
        
        return $statement;
    }
    
    public function getdoctorById($id) {
        //execute a query to get the user with the specific id
        $sqlQuery = "SELECT * FROM doctors WHERE doctorID = :id";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array (
            "id" => $id
        );
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("could not retrieve doctor");
        }
        
        return $statement;
    }
    
    public function insertDoctor($n, $p, $e, $ex) {
        $sqlQuery = "INSERT INTO patients " .
                "(name, phone, email, expertise)" .
                "VALUES (:name, :phone, :email, :expertise)";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "name" => $n,
            "phone" => $p,
            "email" => $e,
            "expertise" => $ex
        );
        
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("could not insert doctor");
        }
        
        $id = $this->connection->lastInsertId();
        
        return $id;
    }
    
    public function updateDoctor ($id, $n, $p, $e, $ex) {
        $sqlQuery = "UPDATE doctors SET " .
                    "name = :name," .
                    "phone = :phone," .
                    "email = :email, " .
                    "expertise = :expertise, " . 
                    "WHERE doctorID = :id";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "doctorID" => $id,
            "name" => $n,
            "phone" => $p,
            "email" => $e,
            "expertise" => $ex
        );
        
        //echo '<pre>';
        //print_r($_POST);
        //print_r($params);
        //print_r($sqlQuery);
        //echo '</pre>';
        
        $status = $statement->execute($params);
        
        return ($statement->rowCount() ==1);
    }
    
}
