<?php

//this is the connection class which allows the web applicton to connect to the database
class Connection {
    private static $connection = NULL;
    
    public static function getInstance() {
        if (Connection::$connection === NULL) {
            $host = 'daneel';
            $database = 'N00130806';
            $username = 'N00130806';
            $password = 'N00130806';
            $dsn = 'mysql:dbname='.$database.":host=".$host;
            
            $dsn = "mysql:host=" . $host . ";dbname=" . $database;
            Connection::$connection = new PDO($dsn, $username, $password);
            if (!Connection::$connection) {
                die("Could not connect to database");
            }
        }
        
        return Connection::$connection;
    }
}
