<?php
include("function.php");
if($session_id){
    include("Admin/Adminlogin.php");
}else{
    include("Main/index.php");
}


?>