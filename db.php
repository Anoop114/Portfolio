<?php

//$link = mysqli_connect("localhost", "root", "", "my_blogs");

if (mysqli_connect_errno()) {
    
    print_r(mysqli_connect_error());
    exit();
    
}

//page index display all blog data
function GetBlogData() {
    $link = mysqli_connect("localhost", "root", "", "my_blogs");

    $query = "SELECT * FROM `blogdata` ORDER BY id DESC";
    $result = mysqli_query($link, $query);
    
    mysqli_close($link);
    return $result;
}

// upload blog data
function CreateBlog($blogNmae,$blogHtml,$untiySceneName,$bannerImageUrl){
    $link = mysqli_connect("localhost", "root", "", "my_blogs");

    $query = "SELECT `id` FROM `blogdata` ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($link, $query);
    $rows = mysqli_fetch_assoc($result);
    
    $folderName = 0;
    if($rows['id'] != null || $rows['id'] != 0){
        $folderName = (int)$rows['id'] + 1;
    }
    
    $sql = "INSERT INTO blogdata 
    (
        blog_name, blog_Data, unity_scene, banner_Image_url, folderName
    )
    VALUES 
    (
        '$blogNmae', '$blogHtml', '$untiySceneName', '$bannerImageUrl', '$folderName'
    )";

    if (mysqli_query($link,$sql)) {

        // ## update further
        // upload file to file table.

        echo "<script> alert('New record created successfully'); </script>";
    } else {
        echo  '<script> alert("Error: " . $sql . "<br>" . $conn->error; </script>';
    }
    mysqli_close($link);
}



// page updateFiles display all files
function GetFileData(){
    $link = mysqli_connect("localhost", "root", "", "my_blogs");

    $query = "SELECT * FROM `filedata` ORDER BY id ASC";
    $result = mysqli_query($link, $query);
    
    mysqli_close($link);
    return $result;
}






//additional Fun.


// return +1 id of current data in blog.
function GetFileLocation(){

    $link = mysqli_connect("localhost", "root", "", "my_blogs");

    $query = "SELECT `id` FROM `blogdata` ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($link, $query);
    $rows = mysqli_fetch_assoc($result);
    
    $folderName = '1';
    if($rows) {
        $folderName = (int)$rows['id'] + 1;
    }

    $filename = "DB/" . (string)$folderName;
    mysqli_close($link);
    return $filename;
}


// create directory of +1 id blog data.
function CreateDirectoryAndAddFile(){
    
    $filename = GetFileLocation();
    if (!file_exists($filename)) {
        mkdir("DB/" . (string)$folderName);
        exit;  
        //echo "<script> alert('The directory exists.'); </script>";
    } 
}

// ## need to update
function DeleteSubFiles(){
    $filename = GetFileLocation();

    $files = glob($filename.'/*'); // get all file names
    foreach($files as $file){ // iterate files
        if(is_file($file)) {
            unlink($file); // delete file
        }
    }
    rmdir($filename);
    echo "<script> alert('delete Success.'); </script>";
}
?>