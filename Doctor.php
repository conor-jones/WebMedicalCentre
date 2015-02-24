<?php
class Doctor {
    private $name;
    private $phone;
    private $email;
    private $expertise;
    
    public function __construct($n, $p, $e, $ex) {
        $this->name = $n;
        $this->phone = $p;
        $this->email = $e;
        $this->expertise = $ex;
    }
    
    public function getName() { return $this->name; }
    public function getPhone() { return $this->phone; }
    public function getEmail() { return $this->email; }
    public function getExpertise() { return $this->expertise; }
    }

