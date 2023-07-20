<?php 
    $blogData = GetBlogData();
?>

<!-- Projects -->
<section class="projects-area">
    <div class="container">
        <div class="col-md-12">
            <h1 class="section-heading" data-aos="fade-up"><img src="./Asset/images/star-2.png" alt="Star"> All
                Projects <img src="./Asset/images/star-2.png" alt="Star"></h1>
        </div>
        <div class="row">
            <?php
                        $rowcount = mysqli_num_rows($blogData);
                        if($rowcount>0){
                            while($data = mysqli_fetch_assoc($blogData)){
                    ?>
            <div class="col-md-4 d-flex align-items-start gap-24">
                <div data-aos="zoom-in" class="flex-1">
                    <div class="project-item shadow-box">
                        <a class="overlay-link" href="?p=Showblog&blogID=<?php echo $data['id']; ?>"></a>
                        <img src="./Asset/images/bg1.png" alt="BG" class="bg-img">
                        <div class="project-img d-flex justify-content-center">
                            <img src="./DB/<?php echo $data['id']; ?>/BannerData.jpg" alt="Project" style="max-height: 250px;height: 100%;  max-width: 250px; width: 100%;">
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="project-info">
                                <h1><?php echo $data['blog_name']; ?></h1>
                            </div>
                            <a href="?p=Showblog&blogID=<?php echo $data['id']; ?>" class="project-btn">
                                <img src="./Asset/fonts/icon.svg" alt="Button">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                            }
                        };
                    ?>
        </div>
    </div>
</section>