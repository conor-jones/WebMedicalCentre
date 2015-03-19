<?php
//require_once 'Patient.php';
require_once 'Connection.php';
require_once 'PatientTableGateway.php';
require_once 'DoctorTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

if (!isset ($_GET) || !isset($_GET['id'])) {
    die('Invalid Request');
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$patientGateway = new PatientTableGateway($connection);
$doctorGateway = new DoctorTableGateway($connection);

$statement = $doctorGateway->getDoctorById($id);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
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
        <?php require 'footer.php'?>
        
        
    </body>
</html>
