<?php
    $fileID = isset($_GET['blogID']) ? $_GET['blogID'] : '';
    
    
    if($fileID == ''){
        $link = GetBlogDataByID('');
    }else{
        $link = GetBlogDataByID($fileID);
    }
    $data = mysqli_fetch_assoc($link);
    
?>

<!-- Breadcrumb -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content" data-aos="fade-up">
            <h1 class="section-heading">
                <?php echo $data['blog_name']; ?> 
            </h1>
                <div class="col-auto">
                    <span class="meta me-md-2"><?php echo $data['created_time']; ?></span>
                </div>
                <?php 
                    if($data['unity_scene'] != ''){
                ?>
                <div class="d-md-flex justify-content-md-end">
                    <a href="#" class="theme-btn">Click to Play</a>
                </div>
                <?php }?>
        </div>
    </div>
</section>


<!-- Blog Items -->
<section class="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-items">
                    <div class="blog-item" data-aos="zoom-in">
                        <div class="img-box">
                            <!-- <div class="d-flex justify-content-end">
                                <a href="blog-details.html" class="theme-btn">Play Game</a>
                            </div> -->
                            <img src="./DB/<?php echo $data['id']; ?>/BannerData.jpg" alt="Blog">
                        </div>
                        <div class="content">
                            <div id="editor">
                                <?php echo $data['blog_Data'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>