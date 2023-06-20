<?php
error_reporting(0);
$json = file_get_contents('php://input');
$data = json_decode($json);
$data ?? exit();
date_default_timezone_set('Asia/Bangkok');
require_once("conn.php");
$tid = $data->tid;
$username = $data->username;
$firstname = $data->firstname;
$lastname = $data->lastname;
$startdate = date("Y-m-d H:i:s");
if ($data->startdate) {
    $startdate = $data->startdate;
}

if ($tid) {
    $sql = "SELECT COUNT(*) as count FROM mod_telegram_member WHERE tid = '$tid'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_fetch_assoc($result)['count'] ?? 0;
    if ($count) {
        echo json_encode(['code' => 1, "smg" => "user existing"]);
    } else {
        $sql = "INSERT INTO `mod_telegram_member`(`id`, `tid`, `username`, `firstname`, `lastname`, `startdate`) VALUES (null,'$tid','$username','$firstname','$lastname','$startdate')";
        $query = mysqli_query($con, $sql);
        if ($query) {
            echo json_encode(['code' => 1, "smg" => "Insert successful"]);
        }
    }
} else {
    echo json_encode(["code" => 0, "smg" => "Undefind Telegram ID"]);
}

require_once("disconn.php");
