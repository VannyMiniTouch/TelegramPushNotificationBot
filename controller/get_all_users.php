<?php
require_once("conn.php");
$sql = "SELECT tid from mod_telegram_member";
$result = mysqli_query($con, $sql);
$assoc = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($assoc);
require_once("disconn.php");
?> 