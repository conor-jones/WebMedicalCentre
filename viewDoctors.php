<?php
require_once 'Connection.php';
require_once 'DoctorTableGateway.php';
require_once 'Doctor.php';

require_once 'ensureUserLoggedIn.php';

$connection = Connection :: getInstance();
$gateway = new DoctorTableGateway($connection);

$statement = $gateway->getDoctors();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- add js link for doctor here -->
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
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Expertise</th>
                </tr>
            </thead>
                <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    echo '<td>' .$row['name'] .'</td>';
                    echo '<td>' .$row['phone'] .'</td>';
                    echo '<td>' .$row['email'] .'</td>';
                    echo '<td>' .$row['expertise'] .'</td>';
                    echo '<td>'
                    . '<a href="viewDoctor.php?id=' .$row['doctorID'].'">View</a> '
                    . '<a href="editDoctorForm.php?id=' .$row['doctorID'].'">Edit</a>'
                    . '<a class="deletePatient" href="deleteDoctor.php?id=' .$row['doctorID'].'">delete</a>'
                    . '</td>';
                    echo '<tr>';
                    $row = $statement-> fetch(PDO::FETCH_ASSOC);
                }
                ?>
        </table>
        <p><a href="createDoctorForm.php">Create Doctor</a></p>
    </body>
</html>
