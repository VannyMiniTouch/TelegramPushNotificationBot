<?php
error_reporting(0);
session_start();
$uriArr  = explode("/", $_SERVER['REQUEST_URI']);
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

switch ($pageUrl) {

    case '/':
        $pagefile = "pages/index.php";
        break;
    case 'create_user':
        include "controller/save_user.php";
        exit();
        break;

    default:
        $pagefile = "pages/index.php";
        break;
}

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
    <title>KG Telegram Notification Management</title>
    <link rel="stylesheet" href="/contens/bootstrap/bootstrap.min.css">
    <script src="/contens/jquery/jquery.min.js"></script>
    <script src="/contens/axios/axios.min.js"></script>
    <link rel="stylesheet" href="/contens/iziToast-master/dist/css/iziToast.min.css">
    <link rel="stylesheet" href="/contens/customstyle.css">

</head>

<body class="" data-lang="<?php echo $_SESSION['lang'] ?>">
    <!--<?php require_once("lang/$dir/$_SESSION[lang]/mod_lang.php"); ?>-->
    <?php
    include $pagefile;
    ?>
</body>

<script src="/contens/bootstrap/bootstrap.bundle.min.js"></script>
<script src="/contens/iziToast-master/dist/js/iziToast.min.js"></script>

</html>

<?php require('controller/disconn.php');
