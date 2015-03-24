<?php
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

$fName = filter_input(INPUT_POST,'fName',   FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lName = filter_input(INPUT_POST,'lName',   FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$address = filter_input(INPUT_POST,'address',   FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$phone = filter_input(INPUT_POST,'phone',  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$doctorID = filter_input(INPUT_POST, 'doctorID', FILTER_SANITIZE_NUMBER_INT);
if ($doctorID == -1) {
    $doctorID = NULL;
}

$id = $gateway->insertPatient($fName, $lName, $address, $phone, $doctorID);

$message = "Patient created successfully";

header('Location: viewPatients.php');

