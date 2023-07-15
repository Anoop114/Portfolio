<?php
    $fileID = isset($_GET['fileID']) ? $_GET['fileID'] : '';
    $fileRespondData = GetBlogDataByID($fileID);
    $data_Blog = mysqli_fetch_assoc($fileRespondData)
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div>
        <div class="d-inline">
            <h2>Disply files <?php echo $data_Blog['blog_name'] ?></h2>
        </div>
        <div class="form-control">
            <div class="table-responsive small">
                <form method="POST" enctype="multipart/form-data">       
                    <div class="row gy-2 gx-3 align-items-center">
                        <div class="col-md-5">
                            <input class="form-control me-2" type="file" name="Image_Data" id="formFile">
                        </div>
                        <div class="col-md-3">
                            <input class="form-check-input" type="checkbox" value="banner_Update" id="flexCheckChecked" name="UpdateBanner">
                            <label class="form-check-label" for="flexCheckChecked"> Banner </label>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-success refresher" type="submit" name="Upload_File">Upload File</button>
                        </div>
                    </div>             
                </form>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col" class="col-md-6">Folder Name</th>
                            <th scope="col">File Name</th>
                        </tr>
                    </thead>

                    <?php
                $fileData = GetFileDataByFolderID($fileID);
                $FileID;
                if(mysqli_num_rows($fileData)>0){
                  while($data = mysqli_fetch_assoc($fileData)){
                ?>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="align-middle f_id"><?php echo $data['id']; ?></td>
                            <td class="align-middle fD_name"><?php echo $data['folderName']; ?></td>
                            <td class="align-middle f_name"><?php echo $data['fileName'];  ?></td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-primary btn-sm view_Btn">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm delete_Btn">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <?php } } ?>
                </table>
            </div>
        </div>
    </div>
</main>


<!-- display image.-->
<main>
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <img class="img-fluid rounded mx-auto d-block" src="" alt="" id="display_Img">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Delete image.-->
<main>
    <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DeleteModalLabel">Delete Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <label for="Delete_Text"> Can I need to delete ? </label>

                    <div class="d-flex justify-content-center">
                        <img class="img-fluid rounded mx-auto d-block" src="" alt="" id="display_del_Img">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="POST">
                        <input type="hidden" name="file_Id" id="delete_input_id">
                        <input type="hidden" name="file_Name" id="delete_input_Name">
                        <button type="submit" class="btn btn-danger" name="Dlelete_file_DB"> DELETE File </button>
                    </form>
                
                </div>
            </div>
        </div>
    </div>
</main>


<script>
    $(document).ready(function(){
        $('.view_Btn').click(function(e){
            e.preventDefault();

            var floder_id = $(this).closest('tr').find('.f_id').text(); 

            $.ajax({
                type: "POST",
                url:"./Admin/addBlogFiles.php",
                data:{
                    'checkView_btn' : true,
                    'f_id' : floder_id,
                },
                success: function(respond){
                    $.each(respond, function(key,value){
                        var folderPointer = './DB/'+value['folderName']+'/'+value['fileName'];
                        $('#display_Img').attr('src', folderPointer);
                    });
                    $('#viewModal').modal('show');
                }
            });
        });
        
        $('.delete_Btn').click(function(e){
            e.preventDefault();
            
            var floder_id = $(this).closest('tr').find('.f_id').text(); 
            
            $.ajax({
                type: "POST",
                url:"./Admin/addBlogFiles.php",
                data:{
                    'checkView_btn' : true,
                    'f_id' : floder_id,
                },
                success: function(respond){
                    $.each(respond, function(key,value){
                        var folderPointer = './DB/'+value['folderName']+'/'+value['fileName'];
                        $('#display_del_Img').attr('src', folderPointer);
                        $('#delete_input_id').val(value['id']);
                        $('#delete_input_Name').val(value['fileName']);
                    });
                    $('#DeleteModal').modal('show');
                }
            });
        });
    });
</script>

<?php

//delete image.

if(isset($_POST['Dlelete_file_DB'])){
    $id = $_POST['file_Id'];
    $f_Name = $_POST['file_Name'];
    $delete_Check = DeleteFileBYID($id);

    $fileLocation = "./DB/" .$data_Blog['id']."/";
    if($delete_Check){
        $FileLoc = $fileLocation.$f_Name;
        if(!unlink($FileLoc)){
            echo '<script> alert("File delete Error delete by manula. "); </script>';
        } 
    }
}



// upload new image.
if(isset($_POST['Upload_File'])){

    $extension  = pathinfo( $_FILES["Image_Data"]["name"], PATHINFO_EXTENSION );
    $Upload_fileName = basename($_FILES["Image_Data"]["name"]);
    $tempname = $_FILES["Image_Data"]["tmp_name"];
    $fileLocation = "./DB/" .$data_Blog['id']."/";
    if(isset($_POST['UpdateBanner']))
    {
        $ExtensionName = UploadFileInDB('BannerData.jpg',$extension,$tempname,$fileLocation);
        if($ExtensionName){
            echo "<script> alert('Somthing error on file upload.'); </script>";
        }else{
            echo "<script> alert('uplodad banner Success.'); </script>";
        }
    }
    else{        
        
        $filename = $Upload_fileName;
        $UploadToDB = InsertFileFolder($filename,$data_Blog['id']);
        if($UploadToDB){
            UploadFileInDB($Upload_fileName,$extension,$tempname,$fileLocation);
        }else{
            echo "<script> alert('file upload fail in local storage pls delete last entry from db and again upload.'); </script>";
        }
    }
}

function UploadFileInDB($uploadeFileName,$extension,$tempname,$fileLoacation){
    $allowTypes = array('jpg','png','jpeg','gif');
    $filename = $uploadeFileName;
    $folder = $fileLoacation. $filename;
    if(in_array($extension, $allowTypes)){
        if (move_uploaded_file($tempname, $folder)) {
            return true;
        } else {
            return false;
        }
    }else {
        return 'null';
    }
}

?>