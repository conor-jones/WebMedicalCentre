<?php

require_once 'Connection.php';
require_once 'PatientTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new PatientTableGateway($connection);

$patientID = $_POST['id'];
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$doctorID = $_POST['doctorID'];

$id = $gateway->updatePatient($patientID, $fName, $lName, $address, $phone, $doctorID);

$message = "Patient updated successfully";

header('Location: viewPatients.php');


