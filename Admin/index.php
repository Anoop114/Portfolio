<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div>


    <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

    <div class="d-inline">
      <h2>All Blogs</h2>
    </div>
    <div class="d-flex justify-content-end mb-3 d-inline">
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success refresher" type="submit">Search</button>
      </form>
    </div>

    <div class="form-control">
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col" class="col-md-6">Blog Name</th>
              <th scope="col">Date</th>
              <th scope="col">Unity Key</th>
              <th scope="col">Edit</th>
            </tr>
          </thead>

          <?php
            $blogData = GetBlogData();
            if(mysqli_num_rows($blogData)>0){
              while($data = mysqli_fetch_assoc($blogData)){
            ?>
          <tbody class="table-group-divider">
            <tr>
              <td class="align-middle b_id"><?php echo $data['id']; ?></td>
              <td class="align-middle"><?php echo $data['blog_name']; ?></td>
              <td class="align-middle"><?php echo $data['created_time'];  ?></td>
              <td class="align-middle"><?php echo $data['unity_scene'];  ?></td>
              <td class="align-middle f_id" style="display: none;"><?php echo $data['folderId'];  ?></td>
              <td class="align-middle">
                <a type="button" class="btn btn-primary btn-sm" href="?p=file&fileID=<?php echo $data['folderId']; ?>"> <i
                    class="bi bi-eye-fill"></i></a>
                <a type="button" class="btn btn-success btn-sm" href="?p=edit&fileID=<?php echo $data['id']; ?>"> <i
                    class="bi bi-pencil-square"></i></a>
                <button type="button" class="btn btn-danger btn-sm delete_Blog_Btn"> <i class="bi bi-trash3"></i></button>
              </td>
            </tr>
          </tbody>
          <?php } } ?>
        </table>
      </div>
    </div>
  </div>
</main>

<!-- delete Blog -->
<main>
  <div class="modal fade" id="DeleteBlogModal" tabindex="-1" aria-labelledby="DeleteBlogModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="DeleteBlogModalLabel">Delete Image</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body ">
                  <h2> Can I need to delete The Blog? </h2>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <form method="POST">
                      <input type="hidden" name="Blog_Id" id="delete_blog_id">
                      <input type="hidden" name="Blog_Folder" id="delete_blog_Folder">
                      <button type="submit" class="btn btn-danger" name="Dlelete_Blog_DB"> Delete Blog </button>
                  </form>
              
              </div>
          </div>
      </div>
  </div>
</main>

<script>
  $(document).ready(function()
  {
    $('.delete_Blog_Btn').click(function(e){
            e.preventDefault();
            
            var Blog_ID = $(this).closest('tr').find('.b_id').text(); 
            var folder_ID = $(this).closest('tr').find('.f_id').text(); 
            $('#delete_blog_id').val(Blog_ID);
            $('#delete_blog_Folder').val(folder_ID);
            $('#DeleteBlogModal').modal('show');  
        });
  });
</script>

<?php
if(isset($_POST['Dlelete_Blog_DB'])){
  $blogId = $_POST['Blog_Id'];
  $folderId = $_POST['Blog_Folder'];
  $requestToDelete = DeleteBlog($blogId);
  if($requestToDelete){
    DeleteAllFilesOfTheBlog($folderId);
  }
}

function DeleteAllFilesOfTheBlog($FolderName){
  $fileDeleteReq = DeleteFileBYFolderID($FolderName);

  if($fileDeleteReq){
    $folderLoc = "./DB/".$FolderName;
    DeleteSubFiles($folderLoc);
  }
}

?>