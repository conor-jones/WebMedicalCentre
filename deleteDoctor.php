<?php
require_once 'Connection.php';
require_once 'DoctorTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid Request');
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new DoctorTableGateway($connection);

$gateway->deleteDoctor($id);

header("Location: viewDoctors.php");
?>

