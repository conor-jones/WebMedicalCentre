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
        <?php 
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <table border="1" style="width:100%">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Doctor ID</th>
                </tr>
            </thead>
                <?php 
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    echo '<td>' .$row['fName'] .'</td>';
                    echo '<td>' .$row['lName'] .'</td>';
                    echo '<td>' .$row['address'] .'</td>';
                    echo '<td>' .$row['phone'] .'</td>';
                    echo '<td>' .$row['doctorName'] .'</td>';
                    echo '<td>'
                    . '<a href="viewPatient.php?id=' .$row['patientID'].'">View</a> '
                    . '<a href="editPatientForm.php?id=' .$row['patientID'].'">Edit</a> '
                    . '<a class="deletePatient" href="deletePatient.php?id='.$row['patientID'].'">delete</a> '        
                    . '</td>';
                    echo '</tr>' ;
                    $row = $statement-> fetch(PDO::FETCH_ASSOC);
                }
                ?>
        </table>
        <p><a href="createPatientForm.php">Create Patient</a></p>
    </body>
</html>
