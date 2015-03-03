<?php
//require_once 'Patient.php';
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

require 'ensureUserLoggedIn.php';

$connection = Connection :: getInstance();
$gateway = new PatientTableGateway($connection);

$statement = $gateway->getPatients();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/Patient.js"></script>
        <title></title>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?> 
        <h2> Welcome </h2>
        <?php 
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <p>A medical centre needs to keep track of the patients that come to the 
            centre for treatment. For each patient, the medical centre needs to 
            record the patient’s name, address, mobile phone number, email address, 
            and date of birth. The patients staying at the medical centre for 
            treatment are assigned to a ward. Each ward can have more than one 
            patient assigned to it. For each ward, the medical centre needs to keep 
            track of the name of the ward, the number of beds in the ward, and the 
            name of the nurse in charge of the ward. If a patient is staying in a 
            ward, then the date the patient was admitted to the ward must be recorded.</p>
        
        <p>One or more doctors may examine each patient. Each doctor may examine 
            one or more patients. For each doctor, the medical centre needs to 
            record the doctor’s name, mobile phone number, email address and area 
            of specialisation. For each doctor that examines a patient, the medical 
            centre needs to record the number of times the doctor has examined that 
            patient and the date of the last examination.</p>
        
        <p>Patients also receive a number of medications. For each medication received 
        by a patient, the medical centre needs to record the date and time the 
        medication was given, the name of the medication, and a description of the 
        dosage given.</p>
        
        
        <?php require 'footer.php'; ?>
    </body>
</html>
