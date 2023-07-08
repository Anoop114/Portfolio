<?php
    $fileID = isset($_GET['fileID']) ? $_GET['fileID'] : '';
    if($fileID == ''){
        //get last id from db.
    }else{
        //connect the given id to db.
    }
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!--Form Start-->
    <form method="POST">
        <section class="my-3 form-control">
            <h2>Update BlogData</h2>
            <div class="my-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="blogTitle" placeholder="Title of blog"
                    value="" />
            </div>
            <div class="my-3">
                <div class="row">
                    <div class="col-md-8">
                        <label for="Title" class="form-label">Scene Name/ID</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="title" name="unityScene"
                                placeholder="Scene Name for Unity" value="" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Choose Image</label>
                <input class="form-control" type="file" name="bannerImage" id="formFile" value="" />
            </div>
            <img src="https://cdn.pixabay.com/photo/2016/11/29/04/19/ocean-1867285__340.jpg"
                class="img-fluid mx-auto d-block  my-3" alt="...">

        </section>
        <section class="my-3 form-control">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-items">
                        <div class="blog-item" data-aos="zoom-in">
                            <textarea id="editor" name="blogData"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <br>
                <button name="createBlog" class="btn btn-success">Save Blog</button>
            </div>
        </section>
    </form>
</main>




<?php
//create blog
if(isset($_POST['createBlog'])){
    
    $unitySceneName = $blogTitle = $blogData = $bannerImage = "";    
    $blogTitle = $_POST['blogTitle'];
    $blogData = $_POST['blogData'];
    $unitySceneName = $_POST['unityScene'];
    $bannerImage = $_POST['bannerImage'];    
    CreateBlog($blogTitle,$blogData,$unitySceneName,$bannerImage);
    //FreeLastUnwantedCreatedDir();
}   

// upload Files.
if(isset($_POST['addFile'])) {
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder =  GetFileLocation() ."/". $filename;
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['uploadfile']['tmp_name']);
    move_uploaded_file($tempname, $folder);
}

if(isset($_POST['deleteImages'])) {
    DeleteSubFiles();
}

?>