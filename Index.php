<?php
include("function.php");
include("db.php");

if($session_id){
    include("Admin/header.php");
    
    if($page == "edit"){
        include("Admin/editBlog.php");
    }
    else if($page == "create"){
        include("Admin/createBlogTitle.php");
    }
    else if($page == "file"){
        include("Admin/updateFiles.php");
    }
    else if($page == "home"){
        include("Admin/index.php");
    }
    else{
        include("Admin/index.php");
    }    
    include("Admin/footer.php");
}
else if($page == "admin_Login"){
    include("Admin/Adminlogin.php");
}
else{

    include("Main/header.php");
    if($page == "Showblog"){
        include("Main/blog.php");
    }else if($page == "cont"){
        include("Main/contact.php");
    }
    else{
        //include("Main/blog.php");
        include("Main/projects.php");
    }

    include("Main/footer.php");
}
?>

