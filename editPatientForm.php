<?php
//require_once 'Patient.php';
require_once 'Connection.php';
require_once 'PatientTableGateway.php';
require_once 'DoctorTableGateway.php';


$id = session_id();
if ($id =="") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['id'])) {
    die("invalid request");
}

$id = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new PatientTableGateway($connection);
$doctorGateway = new DoctorTableGateway($connection);

$patients = $gateway->getPatientById($id);
if ($patients->rowCount() !== 1) {
    die ("Illegal Request");
}

$doctors = $doctorGateway->getDoctors();

$patient = $patients->fetch(PDO::FETCH_ASSOC);
?>
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
        if (isset($errorMessage)) {
            echo '<p>Error: ' .$errorMessage . '</p>';
        }
        ?>
        <form id="editPatientForm" 
              name="editPatientForm" 
              action="editPatient.php" 
              method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
            <table>
                <tbody>
                    <tr>
                        <td>First Name</td>
                        <td>
                            <input type="text" name="fName" value="<?php
                            if (isset($_POST) && isset($_POST['fName'])) {
                                echo $_POST['fName'];
                            }
                            else echo $patient['fName'];
                            ?>"/>
                            <span id="fNameError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['fName'])) {
                                    echo $errorMessage['fName'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Last Name</td>
                        <td>
                            <input type="text" name="lName" value="<?php
                            if (isset($_POST) && isset($_POST['lName'])) {
                                echo $_POST['lName'];
                            }
                            else echo $patient['lName'];
                            ?>"/>
                            <span id="lNameError" class="error">
                                <?php
                                if (isset ($errorMessage) && isset($errorMessage['lName'])) {
                                    echo $errorMessage['lName'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Address</td>
                        <td>
                            <input type='text' name='address' value='<?php
                            if (isset($_POST) && isset($_POST['address'])) {
                                echo $_POST['address'];
                            }
                            else echo $patient['address'];
                            ?>'/>
                            <span id='addressError' class='error'>
                                <?php 
                                if (isset ($errorMessage) && isset($errorMessage['address'])) {
                                    echo $errorMessage['address'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Phone</td>
                        <td>
                            <input type='text' name='phone' value='<?php
                                if (isset($_POST) && isset($_POST['phone'])) {
                                    echo $_POST['phone'];
                                }
                                else echo $patient['phone'];
                                ?>'/>
                            <span id='phoneError' class='error'>
                                <?php
                                if (isset ($errorMessage) && isset($errorMessage['phone'])) {
                                    echo $errorMessage['phone'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Doctor</td>
                        <td>
                            <select name="doctorID">
                                <option value="-1">No Doctor</option>
                                <?php 
                                $d = $doctors->fetch(PDO::FETCH_ASSOC);
                                while ($d) {
                                    $selected = "";
                                    if ($d['doctorID'] == $patient['doctorID']) {
                                        $selected = "selected";
                                    }
                                    echo '<option value="' . $d['doctorID'] . '" ' .$selected . '>' .$d['name'] . '</option>';
                                    $d = $doctors->fetch(PDO::FETCH_ASSOC);
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input  type="submit" value="Update Patient" name="updatePatient"/>
                            <input  type="button" value="Cancel" name="Cancel" onclick="document.loaction.href = 'viewPatients.php'"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php require 'footer.php' ?>
    </body>
</html>
