<?php
//require_once 'Patient.php';
require_once 'Connection.php';
require_once 'PatientTableGateway.php';
require_once 'DoctorTableGateway.php';

$sessionId = session_id();
if ($sessionId == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset ($_GET) || !isset($_GET['id'])) {
    die('Invalid Request');
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$patientGateway = new PatientTableGateway($connection);
$doctorGateway = new DoctorTableGateway($connection);

$patients = $patientGateway->getPatientsByDoctorId($id);
$statement = $doctorGateway->getDoctorById($id);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/doctor.js"></script>
        <title></title>
    </head>
    <body>
        <?php require 'toolbar.php' ?> 
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?> 
        <?php if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        
        <table>
            <tbody>
                <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                
                    echo '<tr>';
                    echo '<td>Doctor ID</td>'
                    .  '<td>' .$row['doctorID'] .'</td>';
                    echo '<tr>';
                
                    echo '<tr>';
                    echo '<td>Name</td>'
                    . '<td>' .$row['name'] .'</td>';
                    echo '</tr>';
                    
                    echo '<tr>';
                    echo '<td>Phone</td>'
                    . '<td>' .$row['phone'] .'</td>';
                    echo '</tr>';
                    
                    echo '<tr>';
                    echo '<td>Email</td>'
                    . '<td>' .$row['email'] .'</td>';
                    echo '</tr>';
                    
                    echo '<tr>';
                    echo '<td>Expertise</td>'
                    . '<td>' .$row['expertise'] .'</td>';
                    echo '</tr>';
                    
                ?>
            </tbody>
        </table>
        <p>
            <a href=editDoctorForm.php?id=<?php echo $row['doctorID'];?>">
                Edit Doctor</a>
            <a class="deleteDoctor" href="deleteDoctor.php?id=<?php echo $row['doctorID'];?>">
            Delete Doctor</a> 
        </p>
        
            <h3>Patients Assigned to <?php echo $row['name']?></h3>
            <?php if ($patients->rowCount() != 0) {?>
            <table>
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
                    $row = $patients->fetch(PDO::FETCH_ASSOC);
                    while ($row) {
                        echo '<td>' .$row['fName'] .'</td>';
                        echo '<td>' .$row['lName'] .'</td>';
                        echo '<td>' .$row['address'] .'</td>';
                        echo '<td>' .$row['phone'] .'</td>';
                        echo '<td>'
                        . '<a href="viewPatient.php?id=' .$row['patientID'].'">View</a> '
                        . '<a href="editPatientForm.php?id=' .$row['patientID'].'">Edit</a> '
                        . '<a class="deletePatient" href="deletePatient.php?id='.$row['patientID'].'">delete</a> '        
                        . '</td>';
                        echo '</tr>' ;
                        $row = $patients-> fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
            </table>
            <?php } else { ?>
            <p>This doctor has no patients</p>
            <?php } ?>
        <?php require 'footer.php'?>
        
        
    </body>
</html>
