<?php
require_once 'Connection.php';
require_once 'DoctorTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$doctorGateway = new DoctorTableGateway($connection);

$doctors = $doctorGateway->getDoctors();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="js/Patient.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?> 
        <h1>Create Patient Form</h1>
        <?php if (isset($errorMessage)) {
            echo '<p>Error: ' . $errorMessage . '</p>';
        }
        ?>
         <form  id="createPatientForm"
                name="createPatientForm"
                action="createPatient.php" 
              method="POST"
              onsubmit="return validateCreatePatient(this);"
              >
            <table >
                <tbody>
                    <tr>
                        <td>First Name</td>
                        <td>
                            <input type="text" name="fName" value="" />
                            <span id="fNameError" class="error">
                                
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td>
                            <input type="text" name="lName" value=""/>
                            <span id="lNameError" class="error">
                                
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>
                            <input type="text" name="address" value="" />
                            <span id="addressError" class="error">
                                
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td>
                            <input type="text" name="phone" value="" />
                            <span id="phoneError" class="error">
                                
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
                                    echo '<option value="' .$d['doctorID'].'">' .$d['name'] . '</option>';
                                    $d = $doctors->fetch(PDO::FETCH_ASSOC);
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Create Patient" name="createPatient" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <?php require 'footer.php' ?>
    </body>
</html>
