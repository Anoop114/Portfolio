<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!--Form Start-->
    <section class="my-3 form-control">
        <h2>New Post</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="my-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="blogTitle" placeholder="Title of blog">
            </div>
            <div class="my-3">
                <div class="row">
                    <div class="col-md-8">
                        <label for="Title" class="form-label">Scene Name/ID</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="title" name="unityScene"
                                placeholder="Scene Name for Unity">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Choose Image</label>
                <input class="form-control" type="file" name="bannerImage" id="formFile">
            </div>
            <button name="createBlog" class="btn btn-success">Save Blog</button>
        </form>
    </section>
    <!--Form End-->


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
}
?>