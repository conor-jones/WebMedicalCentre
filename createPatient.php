<?php
require_once 'Patient.php';
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

$id = session_id();
if ($id =="") {
    session_start();
}

$connection = Connection::getInstance();
$gateway = new PatientTableGateway($connection);

$fName = $_POST['fName'];
$lName = $_POST['lName'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$patientNumber = $_POST['patientNumber'];

$id = $gateway->insertPatient($fName, $lName, $address, $phone, $patientNumber);

$message = "Patient created successfully";

header('Location: home.php');

