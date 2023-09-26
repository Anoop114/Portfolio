<?php
function GetBlogDataDB(){
    
    $link = mysqli_connect("localhost", "root", "", "my_blogs");
    // $link = mysqli_connect("sql212.infinityfree.com", "if0_34732535", "9876543210Anoop", "if0_34732535_blogdata");
    if (mysqli_connect_errno()) {
        
        print_r(mysqli_connect_error());
        exit();
        
    }else{
        return $link;
    }
}

//page index display all blog data
function GetBlogData() {
    $link = GetBlogDataDB();

    $query = "SELECT * FROM `blogdata` ORDER BY id DESC";
    $result = mysqli_query($link, $query);
    
    mysqli_close($link);
    return $result;
}

//page index display by GameType
function GetBlogDataByGameType($gameType) {
    $link = GetBlogDataDB();
    $query;
    if($gameType != ''){

        $query = "SELECT * FROM `blogdata` WHERE `GameType` = '$gameType' ORDER BY `id` DESC";
    }
    else{
        $query = "SELECT * FROM `blogdata` ORDER BY `id` DESC";
    }
    $result = mysqli_query($link, $query);
    
    mysqli_close($link);
    return $result;
}

//Get all BlogData as match
function GetBlogByData($data,$gameType){
    if($data == ''){
        return GetBlogData();
    }else{
        $link = GetBlogDataDB();
        $query;
        if($gameType != ''){
            $query = "SELECT * FROM `blogdata`
                    WHERE `GameType` = '$gameType' AND `blog_Data` LIKE '%$data%' OR `blog_name` LIKE '%$data%'
                    ORDER BY `id` DESC";
        }else{
            $query = "SELECT * FROM `blogdata`
                        WHERE `blog_Data` LIKE '%$data%' OR `blog_name` LIKE '%$data%'
                        ORDER BY `id` DESC";
        }
        $result = mysqli_query($link, $query);
        
        mysqli_close($link);
        return $result;
    }
}

//get blog Data by ID
function GetBlogDataByID($ID) {
    $link = GetBlogDataDB();

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

function GetBlogDataByFileID($ID) {
    $link = GetBlogDataDB();

    $query;
    if($ID == ''){
        $query = "SELECT * FROM `blogdata` ORDER BY id DESC LIMIT 1";
    }else{
        $query = "SELECT * FROM `blogdata` WHERE `folderId`='$ID'";
    }

    $result = mysqli_query($link, $query);
    
    mysqli_close($link);
    return $result;
}


// upload blog data
function CreateBlog($blogNmae,$blogHtml,$untiySceneName,$gameURL,$GameTitle,$extension) {
    $link = GetBlogDataDB();

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
        blog_name, folderId, blog_Data, unity_scene, gameUrl,GameType
    )
    VALUES 
    (
        '$blogNmae', '$folderName','$blogHtml', '$untiySceneName','$gameURL','$GameTitle'
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
        echo  '<script> console.log("Error: " . $sql . "<br>" . $conn->error; </script>';
    }
    mysqli_close($link);
}

//Updata created Blog Title
function UpdateBloge($ID,$blogNmae,$blogHtml,$untiySceneName,$gameType,$gameURL){
    $link = GetBlogDataDB();

    $sql = "UPDATE blogdata SET 
        blog_name = '$blogNmae',
        blog_Data = '$blogHtml',
        unity_scene = '$untiySceneName',
        gameUrl = '$gameURL',
        GameType = '$gameType'
    WHERE id = '$ID'";


    if (mysqli_query($link,$sql)) {
        return true;
        echo "<script> console.log('update completed.'); </script>";
    } else {
        return false;
        echo  '<script> console.log("Error: on upload"); </script>';
    }
    mysqli_close($link);
}

//delete blog

function DeleteBlog($id){
    $link = GetBlogDataDB();
    $sql = "DELETE FROM `blogdata` WHERE `id`= ".$id." ";
    if (mysqli_query($link, $sql)) {
        echo "<script> console.log('Record Delete successfully.'); </script>";
        return true;
        
    }else{
        echo "<script> console.log('Record delete failed.'); </script>";
        return false;
    }
    mysqli_close($link);
}



//update folder file data
function UpdateFileFolder($ID,$file_Name,$folder){
    $link = GetBlogDataDB();
    
    $sql = "UPDATE filedata SET 
        `folderName` = '$folder',
        `fileName` = '$file_Name',
    WHERE id = '$ID' ";

    if (mysqli_query($link,$sql)) {
        echo "<script> console.log('New record created successfully'); </script>";
    } else {
        echo  '<script> console.log("Error: on upload"); </script>';
    }
    mysqli_close($link);
}

//upload folder file data
function InsertFileFolder($file_Name,$folder){
    $link = GetBlogDataDB();
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
        echo "<script> console.log('New record created successfully'); </script>";
    } else {
        return false;
        echo  '<script> console.log("Error: on upload"); </script>';
    }
    mysqli_close($link);
}

//delete Image.
function DeleteFileBYID($id){
    $link = GetBlogDataDB();
    $sql = "DELETE FROM filedata WHERE id='$id'";
    if (mysqli_query($link, $sql)) {
        echo "<script> console.log('Record Delete successfully.'); </script>";
        return true;
        
    }else{
        echo "<script> console.log('Record delete failed.'); </script>";
        return false;
    }
    mysqli_close($link);
}

//delete image
function DeleteFileBYFolderID($id){
    $link = GetBlogDataDB();
    $sql = "DELETE FROM filedata WHERE folderName='$id'";
    if (mysqli_query($link, $sql)) {
        echo "<script> console.log('Delete folder successfully.'); </script>";
        return true;
        
    }else{
        echo "<script> console.log('Delete folder failed.'); </script>";
        return false;
    }
    mysqli_close($link);
}


// page updateFiles display all files
function GetFileDataByFolderID($ID){
    $link = GetBlogDataDB();

    $query = "SELECT * FROM `filedata` WHERE `folderName`='$ID'  ORDER BY id ASC";
    $result = mysqli_query($link, $query);
    
    mysqli_close($link);
    return $result;
}

function GetFileDataByID($ID){
    $link = GetBlogDataDB();

    $query = "SELECT * FROM `filedata` WHERE `id`='$ID'  ORDER BY id ASC";
    $result = mysqli_query($link, $query);
    
    mysqli_close($link);
    return $result;
}





//additional Fun.


// return +1 id of current data in blog.
function GetFileLocation(){

    $link = GetBlogDataDB();
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
    $link = GetBlogDataDB();

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
    echo "<script> console.log('delete local folder Success.'); </script>";
    
    echo '<script> document.location.href = "http://localhost/MY_Portfolio/Portfolio/index.php"; </script>';
    // echo '<script> document.location.href = "https://anoopkrsh.great-site.net/index.php"; </script>';
}
?>