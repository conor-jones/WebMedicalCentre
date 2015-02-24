<?php
class User {
    private $username;
    private $password;
    
    public function __construct($u, $p) {
        $this->username = $u;
        $this->password = $p;
    }
    
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }    
}
