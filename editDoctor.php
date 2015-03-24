<?php
require_once 'Doctor.php';
require_once 'Connection.php';
require_once 'DoctorTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new DoctorTableGateway($connection);

$doctorID = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$expertise = $_POST['expertise'];

$id = $gateway->updateDoctor($doctorID, $name, $phone, $email, $expertise);

$message = "Doctor updated successfully";

header('Location: viewDoctors.php');


