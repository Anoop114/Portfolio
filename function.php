<?php

session_start();

$page = isset($_GET['p']) ? $_GET['p'] : '';
$function = isset($_GET['function']) ? $_GET['function'] : '';
$session_id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

if ($function == "logout") {
        
    session_unset();
    header("Location: http://localhost/MY_Portfolio/Portfolio/");
    exit();
}
?>