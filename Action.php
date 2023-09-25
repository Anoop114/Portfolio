<?php
include("function.php");
if ($_GET['action'] == "login"){
    
    if ( '123' == $_POST['pass'] && 'anoop@gmail.com' == $_POST['user']) {
        
        $_SESSION['id'] = 1;
        header("location: index.php");
    } else {
        //echo "Enter correct username/password";
        header("Location: index.php?error =Incorrect User name or password");

        exit();
    }

}
?>