<?php
// error_reporting(0);
session_start();
$json = file_get_contents('php://input');
$data = json_decode($json);

$data ?? exit();

require_once("conn.php");

$username = $data->username;
$password = md5($data->password);

$sql_select = "SELECT * FROM mod_user_login WHERE username = '$username' AND password = '$password'";
$result_select = $con->query($sql_select);
$row = mysqli_fetch_assoc($result_select);

if ($row > 0) {
    //Set Session
    $_SESSION['username'] = $row['username'];
    $_SESSION['login']   = 1;
    echo json_encode(["code" => 1, "smg" => "Login Succesful!"]);
} else {
    echo json_encode(["code" => 0, "smg" => "Username or password incorrect!"]);
}
require_once("disconn.php");
