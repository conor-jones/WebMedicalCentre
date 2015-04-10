<?php
//require_once 'Patient.php';
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

require 'ensureUserLoggedIn.php';

if (isset($_GET) && isset($_GET['sortOrder'])){
    $sortOrder = $_GET['sortOrder'];
    $columnNames = array("fName", "lName", "address", "phone", "doctorName");
    if (!in_array($sortOrder, $columnNames)){
        $sortOrder = 'fName';
    }
}
else {
    $sortOrder = 'fName';
}

$connection = Connection :: getInstance();
$gateway = new PatientTableGateway($connection);

$statement = $gateway->getPatients($sortOrder);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/patient.js"></script>
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
                    <th><a href="viewPatients.php?sortOrder=fName">First Name</a></th>
                    <th><a href="viewPatients.php?sortOrder=lName">Last Name</a></th>
                    <th><a href="viewPatients.php?sortOrder=address">Address</a></th>
                    <th><a href="viewPatients.php?sortOrder=phone">Phone</a></th>
                    <th><a href="viewPatients.php?sortOrder=doctorName">Doctor ID</a></th>
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
