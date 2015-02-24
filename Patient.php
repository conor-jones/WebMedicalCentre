<?php
class Patient {
    private $fName;
    private $lName;
    private $address;
    private $phone;
    private $patientNumber;
    
    public function __construct($fn, $ln, $a, $p, $pn) {
        $this->fName = $fn;
        $this->lName = $ln;
        $this->address = $a;
        $this->phone = $p;
        $this->patientNumber = $pn;
    }
    
    public function getFName() { return $this->fName; }
    public function getLName() { return $this->lName; }
    public function getAddress() { return $this->address; }
    public function getPhone() { return $this->phone; }
    public function getPatientNumber() { return $this->patientNumber; }
}
