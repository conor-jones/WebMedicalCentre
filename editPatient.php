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

$patientID = filter_input(INPUT_POST, 'id',          FILTER_SANITIZE_NUMBER_INT);
$fName = filter_input(INPUT_POST, 'fName',          FILTER_SANITIZE_NUMBER_STRING);
$lName = filter_input(INPUT_POST, 'lName',          FILTER_SANITIZE_NUMBER_STRING);
$address = filter_input(INPUT_POST, 'address',          FILTER_SANITIZE_NUMBER_STRING);
$phone = filter_input(INPUT_POST, 'phone',          FILTER_SANITIZE_NUMBER_STRING);
$doctorID = filter_input(INPUT_POST, 'dId',          FILTER_SANITIZE_NUMBER_INT);
if ($doctorID == -1) {
    $managerID = NULL;
}

$gateway->updatePatient($id,$fn, $ln, $a, $p, $dId);

    header('Location: viewPatients.php');


