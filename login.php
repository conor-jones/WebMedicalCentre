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
        <?php
        if (!isset($username)) {
            $username ='';
        }
        ?>
        <form action="checkLogin.php" method="POST">
            <table border="0">
                <tbody>
                    <tr>
                        <td>Username</td>
                        <td>
                            <input type="text" 
                                   name="username" 
                                   value="<?php echo $username; ?>"/>
                            <span id="usernameError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['username'])) {
                                    echo $errorMessage['username'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>
                            <input type="Password" name="password" value=""/>
                            <span id="passwordError" class="error">
                                <?php 
                                if (isset($errorMessage) && isset($errorMessage['password'])) {
                                    echo $errorMessage['password'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Login" name="login"/>
                            <input type="button"
                                   value="Register"
                                   name="register"
                                   onclick="document.location.href= 'register.php'"
                                   />
                            <input type='button' value='Forgot Password' name='forgot' />
                        </td>
                    </tr>
                </tbody>                       
            </table>
        </form>
        <?php require 'footer.php' ?>
    </body>
</html>
