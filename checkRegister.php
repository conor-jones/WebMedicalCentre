<?php
require_once 'User.php';
require_once 'Connection.php';
require_once 'UserTableGateway.php';

$connection = Connection::getInstance();

$gateway = new UserTableGateway($connection);

$id = session_id();
if ($id == "") {
    session_start();
}

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);

$errorMessage = array();
if ($username === FALSE || $username === '') {
    $errorMessage['username'] = 'Username must not be blank<br/>';
}
else {
    //execute sql query to see if user name alreadt exists
    $statement = $gateway->getUserByUsername($username);
    
    //if the statement is in the database the add an error message
    //to the error message array
    
    if ($statement->rowCount() !==0) {
        $errorMessage['username'] = 'Username already registered<br/>';
    }
}
    
if ($password === FALSE || $password === '') {
    $errorMessage['password'] = 'Password must not be blank<br/>';
}

if ($password2 === FALSE || $password2 === '') {
    $errorMessage['password2'] = 'Password2 must not be blank<br/>';
}
else if ($password !== $password2) {
    $errorMessage['password2'] = 'Passwords must match<br/>';
}

if (empty($errorMessage)) { //empty array brings user to home.php
    $gateway->insertUser($username, $password);
    $_SESSION['username'] = $username;
    header('Location: home.php');
}
else {
    require 'register.php';
}










