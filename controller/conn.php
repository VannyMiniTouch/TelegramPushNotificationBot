<?php
date_default_timezone_set('Asia/Bangkok');
$con = new mysqli('localhost', 'root', 'root', 'bot_members');
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}
?>