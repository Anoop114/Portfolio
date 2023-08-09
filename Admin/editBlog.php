<?php
    
    $fileID = isset($_GET['fileID']) ? $_GET['fileID'] : '';
    
    $data; $link;
    

    // fetch data from blog
    if($fileID == ''){
        $link = GetBlogDataByID('');
    }else{
        $link = GetBlogDataByID($fileID);
    }
    $data = mysqli_fetch_assoc($link);

    //fetch data from File.


?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!--Form Start-->
    <form method="POST" enctype="multipart/form-data">
        <section class="my-3 form-control">
            <h2>Update BlogData</h2>
            <div class="my-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="blogTitle" placeholder="Title of blog"
                    value="<?php echo $data['blog_name']; ?>" />
            </div>
            <div class="my-3">
                <div class="row">
                    <div class="col-md-8">
                        <label for="Title" class="form-label">Scene Name/ID</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="title" name="unityScene"
                                placeholder="Scene Name for Unity" value="<?php echo $data['unity_scene']; ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Uploaded Image</label>
            </div>
            <img src="./DB/<?php echo $data['id']; ?>/BannerData.jpg" class="img-fluid mx-auto d-block  my-3">

        </section>
        <section class="my-3 form-control">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-items">
                        <div class="blog-item" data-aos="zoom-in">
                            <textarea id="editor" name="blogData"><?php echo $data['blog_Data']; ?></textarea>
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
    
    $unitySceneName = $blogTitle = $blogData = "";    
    $blogTitle = $_POST['blogTitle'];
    $unitySceneName = $_POST['unityScene'];
    $blogData = $_POST['blogData'];
    $result = UpdateBloge($data['id'],$blogTitle,$blogData,$unitySceneName);
    if($result){
        echo '<script> document.location.href = "http://localhost/MY_Portfolio/Portfolio/index.php?p=home"; </script>';
        // echo '<script> document.location.href = "http://anoopkrsh.great-site.net/index.php?p=home"; </script>';
    }
}

?>