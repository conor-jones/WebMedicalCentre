<?php
//require_once 'Patient.php';
require_once 'Connection.php';
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
$gateway = new DoctorTableGateway($connection);

$statement = $gateway->getDoctorById($id);
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
        <?php require 'header.php' ?> 
        <?php require 'mainMenu.php' ?>
        <?php
        if (isset($errorMessage)) {
            echo '<p>Error: ' .$errorMessage . '</p>';
        }
        ?>
        
        <form id="editDoctorForm"
              name="editDoctorForm"
              action="editDoctor.php"
            method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <table>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>
                            <input type="text" name="name" value="<?php
                            if (isset($_POST) && isset($_POST['name'])) {
                                echo $_POST['name'];
                            }
                            else echo $row['name'];
                            ?>"/>
                            <span id="nameError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['name'])) {
                                    echo $errorMessage['name'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    
                    <tr>
                    <td>Phone</td>
                        <td>
                            <input type="text" name="phone" value="<?php
                            if (isset($_POST) && isset($_POST['phone'])) {
                                echo $_POST['phone'];
                            }
                            else echo $row['phone'];
                            ?>"/>
                            <span id="phoneError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['phone'])) {
                                    echo $errorMessage['phone'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    
                    <tr>
                    <td>Email</td>
                        <td>
                            <input type="text" name="email" value="<?php
                            if (isset($_POST) && isset($_POST['email'])) {
                                echo $_POST['email'];
                            }
                            else echo $row['email'];
                            ?>"/>
                            <span id="emailError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['email'])) {
                                    echo $errorMessage['email'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    
                    <tr>
                    <td>Expertise</td>
                        <td>
                            <input type="text" name="expertise" value="<?php
                            if (isset($_POST) && isset($_POST['expertise'])) {
                                echo $_POST['expertise'];
                            }
                            else echo $row['expertise'];
                            ?>"/>
                            <span id="expertiseError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['expertise'])) {
                                    echo $errorMessage['expertise'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input  type="submit" value="Update Doctor" name="updateDoctor"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php require 'footer.php' ?>
    </body>
</html>
