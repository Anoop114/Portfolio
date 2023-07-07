<?php

$link = mysqli_connect("localhost", "root", "", "my_blogs");

if (mysqli_connect_errno()) {
    
    print_r(mysqli_connect_error());
    exit();
    
}

function GetBlogData() {
    $link = mysqli_connect("localhost", "root", "", "my_blogs");

    $query = "SELECT * FROM `blogdata` ORDER BY id DESC";
    $result = mysqli_query($link, $query);
    
    mysqli_close($link);
    return $result;
}


function CreateBlog($blogNmae,$blogHtml,$untiySceneName,$bannerImageUrl)
{
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
        blog_name, 
        blog_Data,
        unity_scene,
        banner_Image_url,
        folderName
    )
    VALUES 
    (
        '$blogNmae',
        '$blogHtml',
        '$untiySceneName',
        '$bannerImageUrl',
        '$folderName'
    )";

    if (mysqli_query($link,$sql)) {
        echo "<script> alert('New record created successfully'); </script>";
    } else {
        echo  '<script> alert("Error: " . $sql . "<br>" . $conn->error; </script>';
    }
    mysqli_close($link);
}


function FreeLastUnwantedCreatedDir(){
    $link = mysqli_connect("localhost", "root", "", "my_blogs");

    $query = "SELECT `id` FROM `blogdata` ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($link, $query);
    $rows = mysqli_fetch_assoc($result);
    
    $folderName = '1';
    if($rows) {
        $folderName = (int)$rows['id'] + 1;
    }

    $filename = "DB/" . (string)$folderName;

    if (file_exists($filename)) {
        
        $files = glob($filename.'/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file)) {
                unlink($file); // delete file
            }
        }
        
        echo "<script> alert('The directory exists.'); </script>";
    } else {
        mkdir("DB/" . (string)$folderName);
        echo "<script> alert('The directory was successfully created.'); </script>";
        exit;
    }
    mysqli_close($link);

}
?>