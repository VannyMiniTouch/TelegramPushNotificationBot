<?php
error_reporting(0);
session_start();
$uriArr  = explode("/", $_SERVER['REQUEST_URI']);
//print_r($uriArr);
if (isset($_GET['page']) || (strlen($uriArr[1]) > 2 && $uriArr[1] != 'index.php')) {
    if (isset($_GET['page'])) {
        $pageUrl = $_GET['page'];
    } else {
        if (strlen($uriArr[1]) > 2) {
            $pageUrl = $uriArr[1];
        } else {
            $pageUrl = $uriArr[2];
        }
    }
}
if ((strlen($uriArr[1]) == 2 && (in_array($uriArr[1], array('en', 'cn'))))) {
    $lang   = $uriArr[1];

    $_SESSION['lang'] = $lang;
    $pageUrl      = $uriArr['2'];
}
$pagefile = "pages/index.php";

include "config/function.php";

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = "en";
    $_SESSION['lang_name'] = "English";
} else if (isset($_GET['lang']) && strlen(isset($_GET['lang']) == 2)) {
    if ($_GET['lang'] == "cn") {
        $_SESSION['lang'] = "cn";
        $_SESSION['lang_name'] = "中文";
    } else if ($_GET['lang'] == "en") {
        $_SESSION['lang'] = "en";
        $_SESSION['lang_name'] = "English";
    } else {
        $_SESSION['lang'] = "en";
        $_SESSION['lang_name'] = "English";
    }
}
require('controller/conn.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KG Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- custom css -->
    <link rel="stylesheet" href="/assets/tinymce/skins/lightgray/skin.min.css">
    <!-- <script src="/assets/tinymce/tinymce.min.js"></script> -->
    <script src="https://fafabae55.icg888.co/content/js/tinymce/tinymce.min.js"></script>


</head>

<body class="" data-lang="<?php echo $_SESSION['lang'] ?>">
    <!--<?php require_once("lang/$dir/$_SESSION[lang]/mod_lang.php"); ?>-->
    <?php
    include $pagefile;
    ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>

<?php require('controller/disconn.php');
