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

$doctors = $doctorGateway->getDoctors()
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="js/Doctor.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php'?>
        <?php require 'header.php'?>
        <?php require 'mainMenu.php' ?>
        <h1>Create Doctor Form</h1>
        <?php if (isset($errorMessage)) {
            echo '<p>Error: ' .$errorMessage . '</p>';
        }
        ?>
        
        <form id="createDoctorForm"
              name="createDoctorForm"
              action="createDoctor.php"
              method="POST"
              onsubmit="return validateCreateDoctor(this);"
              > 
            <table>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>
                            <input type="text" name="name" value=""/>
                            <span id="nameError" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>
                            <input type="text" name="phone" value=""/>
                            <span id="phoenError" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type="text" name="email" value=""/>
                            <span id="phoenError" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Expertise</td>
                        <td>
                            <input type="text" name="expertise" value=""/>
                            <span id="expertiseError" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Create Doctor" name="createDoctor"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php require 'footer.php' ?>
    </body>
</html>
