<?php

$session_id = session_id();
if ($session_id == "") {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

