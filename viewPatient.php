<?php
require_once 'Patient.php';
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

if (!isset ($_GET) || !isset($_GET['id'])) {
    die('Invalid Request');
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new PatientTableGateway($connection);

$statement = $gateway->getPatientById($id);
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
        <?php if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        
        <table>
            <tbody>
                <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                    echo '<tr>';
                    echo '<td>First Name</td>'
                    . '<td>' .$row['fName'] .'</td>';
                    echo '</tr>';
                    
                    echo '<tr>';
                    echo '<td>Last Name</td>'
                    . '<td>' .$row['lName'] .'</td>';
                    echo '</tr>';
                    
                    echo '<tr>';
                    echo '<td>Address</td>'
                    . '<td>' .$row['address'] .'</td>';
                    echo '</tr>';
                    
                    echo '<tr>';
                    echo '<td>Phone Number</td>'
                    . '<td>' .$row['phone'] .'</td>';
                    echo '</tr>';
                    
                    echo '<tr>';
                    echo '<td>Patient Number</td>'
                    . '<tr>' .$row['patientNumber'] .'</td>';
                    echo '</tr>';
                ?>
            </tbody>
        </table>
        <p>
            <a href  ="editPatientForm.php?id=<?php echo $row['patientID'];?>">
                Edit Patient</a>
            <a class="deletePatient" href="deletePatient.php?id=<?php echo $row['patientID']; ?>">
                Delete Patient</a>
        </p>
                
                    
            </tbody>
        </table>
        <?php require 'footer.php' ?>
    </body>
</html>

