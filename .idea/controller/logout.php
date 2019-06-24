<?php
session_start();
if ($_SESSION['owner_id'] == null) {
    include 'auth_failed.php';
}
$_SESSION['owner_id'] = null;
$_SESSION['role'] = null;
session_abort();

echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
    ."<a href='../view/login.html'>  [ Back to login page ]</a></div><br/><br/><br/></fieldset>";