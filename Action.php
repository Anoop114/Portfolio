<?php

if ($_GET['action'] == "login"){
    echo("login call");
    
    if ( '123' == $_POST['pass'] && 'anoop@gmail.com' == $_POST['user']) {
        
        $_SESSION['id'] = 1;
        header("location:Admin/index.php");
    } else {
        //echo "Enter correct username/password";
        header("Location: index.php?error=Incorect User name or password");

        exit();
    }

}












?>