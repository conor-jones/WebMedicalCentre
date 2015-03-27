<?php
require_once 'Connection.php';
require_once 'DoctorTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$id = session_id();
if ($id =="") {
    session_start();
}

$connection = Connection::getInstance();
$doctorGateway = new DoctorTableGateway($connection);

$name = filter_input(INPUT_POST,'name',   FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$phone = filter_input(INPUT_POST,'phone',   FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST,'email',   FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$expertise = filter_input(INPUT_POST,'expertise',  FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$id = $doctorGateway->insertDoctor($name, $phone, $email, $expertise);

$message = "Doctor created successfully";

header('Location: viewDoctors.php');

