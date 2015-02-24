<?php
require_once 'Patient.php';
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

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

$statement = $gateway->getPatientById($id);
if ($statement->rowCount() !== 1) {
    die ("Illegal Request");
}

$row = $statement->fetch(PDO::FETCH_ASSOC);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/Patient.js"></script>
        <title></title>
    </head>
    <body>
         <?php require 'toolbar.php' ?>
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
                            else echo $row['fName'];
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
                            else echo $row['lName'];
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
                            else echo $row['address'];
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
                                else echo $row['phone'];
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
                        <td>Patient Number</td>
                        <td>
                            <input type='text' name='patientNumber' value='<?php
                                if (isset($_POST) && isset($_POST['patientNumber'])) {
                                    echo $_POST['patientNumber'];
                                }
                                else echo $row['patientNumber'];
                                ?>'/>
                            <span id="patientNumberError" class="error">
                                <?php 
                                if (isset($errorMessage) && isset($errorMessage)) {
                                    echo $errorMessage['patientNumber'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Update Patient" name="updatePatient"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </body>
</html>
