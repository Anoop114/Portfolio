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
//get blog Data by ID
function GetBlogDataByID($ID) {
    $link = mysqli_connect("localhost", "root", "", "my_blogs");

    $query;
    if($ID == ''){
        $query = "SELECT * FROM `blogdata` ORDER BY id DESC LIMIT 1";
    }else{
        $query = "SELECT * FROM `blogdata` WHERE `id`='$ID'";
    }

    $result = mysqli_query($link, $query);
    
    mysqli_close($link);
    return $result;
}

// upload blog data
function CreateBlog($blogNmae,$blogHtml,$untiySceneName,$extension){
    $link = mysqli_connect("localhost", "root", "", "my_blogs");

    $query = "SELECT `id` FROM `blogdata` ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($link, $query);
    $rows = mysqli_fetch_assoc($result);

    $folderName = 1;
    if(mysqli_num_rows($result)>0){
        $folderName = (int)$rows['id'] + 1;
    }
    
    $BannerName = "BannerData"."."."$extension";

    $sql = "INSERT INTO blogdata 
    (
        blog_name, blog_Data, unity_scene
    )
    VALUES 
    (
        '$blogNmae', '$blogHtml', '$untiySceneName'
    )";

    if (mysqli_query($link,$sql)) {

        // ## update further
        // upload file to file table.
        $uploadFliesInDB = InsertFileFolder($BannerName,$folderName);
        if($uploadFliesInDB){
            return true;
            echo "<script> console.log('create complete.'); </script>";
        }else{
            return false;
        }
    } else {
        return false;
        echo  '<script> alert("Error: " . $sql . "<br>" . $conn->error; </script>';
    }
    mysqli_close($link);
}

//Updata created Blog Title
function UpdateBloge($ID,$blogNmae,$blogHtml,$untiySceneName){
    $link = mysqli_connect("localhost", "root", "", "my_blogs");

    $sql = "UPDATE blogdata SET 
        blog_name = '$blogNmae',
        blog_Data = '$blogHtml',
        unity_scene = '$untiySceneName'
    WHERE id = '$ID'";


    if (mysqli_query($link,$sql)) {
        return true;
        echo "<script> alert('update completed.'); </script>";
    } else {
        return false;
        echo  '<script> alert("Error: on upload"); </script>';
    }
    mysqli_close($link);
}

//delete blog

function DeleteBlog($id){
    $link = mysqli_connect("localhost", "root", "", "my_blogs");
    $sql = "DELETE FROM `blogdata` WHERE `id`= ".$id." ";
    if (mysqli_query($link, $sql)) {
        echo "<script> alert('Record Delete successfully.'); </script>";
        return true;
        
    }else{
        echo "<script> alert('Record delete failed.'); </script>";
        return false;
    }
    mysqli_close($link);
}



//update folder file data
function UpdateFileFolder($ID,$file_Name,$folder){
    $link = mysqli_connect("localhost", "root", "", "my_blogs");
    
    $sql = "UPDATE filedata SET 
        `folderName` = '$folder',
        `fileName` = '$file_Name',
    WHERE id = '$ID' ";

    if (mysqli_query($link,$sql)) {
        echo "<script> alert('New record created successfully'); </script>";
    } else {
        echo  '<script> alert("Error: on upload"); </script>';
    }
    mysqli_close($link);
}

//upload folder file data
function InsertFileFolder($file_Name,$folder){
    $link = mysqli_connect("localhost", "root", "", "my_blogs");
    $sql = "INSERT INTO filedata 
    (
        `folderName`, `fileName`
    )
    VALUES
    (
        '$folder','$file_Name'
    )";

    if (mysqli_query($link,$sql)) {
        return true;
        echo "<script> alert('New record created successfully'); </script>";
    } else {
        return false;
        echo  '<script> alert("Error: on upload"); </script>';
    }
    mysqli_close($link);
}

//delete Image.
function DeleteFileBYID($id){
    $link = mysqli_connect("localhost", "root", "", "my_blogs");
    $sql = "DELETE FROM filedata WHERE id='$id'";
    if (mysqli_query($link, $sql)) {
        echo "<script> alert('Record Delete successfully.'); </script>";
        return true;
        
    }else{
        echo "<script> alert('Record delete failed.'); </script>";
        return false;
    }
    mysqli_close($link);
}

//delete image
function DeleteFileBYFolderID($id){
    $link = mysqli_connect("localhost", "root", "", "my_blogs");
    $sql = "DELETE FROM filedata WHERE folderName='$id'";
    if (mysqli_query($link, $sql)) {
        echo "<script> alert('Delete folder successfully.'); </script>";
        return true;
        
    }else{
        echo "<script> alert('Delete folder failed.'); </script>";
        return false;
    }
    mysqli_close($link);
}


// page updateFiles display all files
function GetFileDataByFolderID($ID){
    $link = mysqli_connect("localhost", "root", "", "my_blogs");

    $query = "SELECT * FROM `filedata` WHERE `folderName`='$ID'  ORDER BY id ASC";
    $result = mysqli_query($link, $query);
    
    mysqli_close($link);
    return $result;
}

function GetFileDataByID($ID){
    $link = mysqli_connect("localhost", "root", "", "my_blogs");

    $query = "SELECT * FROM `filedata` WHERE `id`='$ID'  ORDER BY id ASC";
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

    $filename = "./DB/" . (string)$folderName;
    mysqli_close($link);
    return $filename;
}


// create directory of +1 id blog data.
function CreateDirectoryAndAddFile(){
    $link = mysqli_connect("localhost", "root", "", "my_blogs");

    $query = "SELECT `id` FROM `blogdata` ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($link, $query);
    $rows = mysqli_fetch_assoc($result);
    
    $folderName = '1';
    if($rows) {
        $folderName = (int)$rows['id'] + 1;
    }
    mysqli_close($link);

    $filename = "./DB/" . (string)$folderName;
    if (!file_exists($filename)) {
        mkdir("./DB/" . (string)$folderName);
    } 
}

// delete folder from db.
function DeleteSubFiles($filename){
    $files = glob($filename.'/*'); // get all file names
    foreach($files as $file){ // iterate files
        if(is_file($file)) {
            unlink($file); // delete file
        }
    }
    rmdir($filename);
    echo "<script> alert('delete local folder Success.'); </script>";
}
?>