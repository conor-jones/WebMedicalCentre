<?php
//the patienttablegateway class is where the functions are written for the sql queries
class PatientTableGateway {
    
    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
    }
    
    //the getPatients function is used for the view option. it uses the 'SELECT' statement to get the entire patients table
    public function getPatients() {
        //execute a query to get all patients
        $sqlQuery = "SELECT p.*, d.name AS doctorName 
                    FROM patients p
                    LEFT JOIN doctors d ON d.doctorID = p.doctorID";
        
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();
        
        if(!$status) {
            die("Could not retrieve patients");
        }
        
        return $statement;
    }
    
    
    //the getPatientsById function is used for viewing individual patients. it uses the 'SELECT' statement to get the patients one at a time by there patientID
    public function getPatientById($id) {
        //execute a query to get the user with the specific id
        $sqlQuery = "SELECT p.*, d.name AS doctorName 
                    FROM patients p
                    LEFT JOIN doctors d ON d.doctorID = p.doctorID
                    WHERE p.patientId = :id";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array (
            "id" => $id
        );
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("could not retrieve patient");
        }
        
        return $statement;
    }
    
    
    //the insertPatient is used for creating new patients for the table. it uses the 'INSERT' statement to input new data intop the database table 
    public function insertPatient($fn, $ln, $a, $p, $dId) {
        $sqlQuery = "INSERT INTO patients " .
                "(fName, lName, address, phone, doctorID)" .
                " VALUES (:fName, :lName, :address, :phone, :doctorID)";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "fName" => $fn,
            "lName" => $ln,
            "address" => $a,
            "phone" => $p,
            "doctorID" => $dId
        );
        
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("could not insert patient");
        }
        
        $id = $this->connection->lastInsertId();
        
        return $id;
    }
    
    
    //the deletePatient function is used to selete patients from the table.
    public function deletePatient($id) {
        $sqlQuery = "DELETE FROM patients WHERE patientID = :id";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array (
            "id" => $id
        );
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("could not delete patient");
        }
        return ($statement->rowCount() ==1);
    }
    
    
    //the updatePatient  
    public function updatePatient ($id, $fn, $ln, $a, $p, $dId) {
        $sqlQuery = "UPDATE patients SET " .
                    " fName = :fName, " .
                    " lName = :lName, " .
                    " address = :address, " .
                    " phone = :phone, " . 
                    " doctorID = :doctorID " .
                    " WHERE patientId = :id";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id,
            "fName" => $fn,
            "lName" => $ln,
            "address" => $a,
            "phone" => $p,
            "doctorID" => $dId
        );
        
        //echo '<pre>';
        //print_r($_POST);
        //print_r($params);
        //print_r($sqlQuery);
        //echo '</pre>';
        
        $status = $statement->execute($params);
        
        if(!$status)
        {
            die("could not update patient");
        }
        return ($statement->rowCount() ==1);
    }
    
    
}
