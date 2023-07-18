<?php 
    $blogData = GetBlogData();
?>

<!-- Projects -->
<section class="projects-area">
    <div class="container">
        <h1 class="section-heading" data-aos="fade-up"><img src="./Asset/images/star-2.png" alt="Star"> All Projects
            <img src="./Asset/images/star-2.png" alt="Star"></h1>
        <div class="row">
            <!-- 
                <div class="col-md-4">
                <div data-aos="zoom-in">
                    <div class="project-item shadow-box">
                        <a class="overlay-link" href="./work-details.html"></a>
                        <img src="./Asset/images/bg1.png" alt="BG" class="bg-img">
                        <div class="project-img">
                            <img src="./Asset/images/project1.jpeg" alt="Project">
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="project-info">
                                <p>WEB DESIGNING</p>
                                <h1>Dynamic</h1>
                            </div>
                            <a href="work-details.html" class="project-btn">
                                <img src="./Asset/fonts/icon.svg" alt="Button">
                            </a>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in">
                    <div class="project-item shadow-box">
                        <a class="overlay-link" href="./work-details.html"></a>
                        <img src="./Asset/images/bg1.png" alt="BG" class="bg-img">
                        <div class="project-img">
                            <img src="./Asset/images/project2.jpeg" alt="Project">
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="project-info">
                                <p>PHOTOGRAPHY</p>
                                <h1>Diesel H1</h1>
                            </div>
                            <a href="work-details.html" class="project-btn">
                                <img src="./Asset/fonts/icon.svg" alt="Button">
                            </a>
                        </div>
                    </div>
                </div>

                </div>
             -->
            <div class="col-md-12">
                <h1 class="section-heading" data-aos="fade-up"><img src="./Asset/images/star-2.png" alt="Star"> All
                    Projects <img src="./Asset/images/star-2.png" alt="Star"></h1>
            <!-- 
                <div class="d-flex align-items-start gap-24">
                    <div data-aos="zoom-in" class="flex-1">
                        <div class="project-item shadow-box">
                            <a class="overlay-link" href="./work-details.html"></a>
                            <img src="./Asset/images/bg1.png" alt="BG" class="bg-img">
                            <div class="project-img">
                                <img src="./Asset/images/project3.jpeg" alt="Project">
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="project-info">
                                    <p>mOBILE DESIGNING</p>
                                    <h1>Seven Studio</h1>
                                </div>
                                <a href="work-details.html" class="project-btn">
                                    <img src="./Asset/fonts/icon.svg" alt="Button">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div data-aos="zoom-in" class="flex-1">
                        <div class="project-item shadow-box">
                            <a class="overlay-link" href="./work-details.html"></a>
                            <img src="./Asset/images/bg1.png" alt="BG" class="bg-img">
                            <div class="project-img">
                                <img src="./Asset/images/project4.jpeg" alt="Project">
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="project-info">
                                    <p>Branding</p>
                                    <h1>Raven Studio</h1>
                                </div>
                                <a href="work-details.html" class="project-btn">
                                    <img src="./Asset/fonts/icon.svg" alt="Button">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-24">
                    <div data-aos="zoom-in" class="flex-1">
                        <div class="project-item shadow-box">
                            <a class="overlay-link" href="./work-details.html"></a>
                            <img src="./Asset/images/bg1.png" alt="BG" class="bg-img">
                            <div class="project-img">
                                <img src="./Asset/images/project5.jpeg" alt="Project">
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="project-info">
                                    <p>mOBILE DESIGNING</p>
                                    <h1>Submarine</h1>
                                </div>
                                <a href="work-details.html" class="project-btn">
                                    <img src="./Asset/fonts/icon.svg" alt="Button">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div data-aos="zoom-in" class="flex-1">
                        <div class="project-item shadow-box">
                            <a class="overlay-link" href="./work-details.html"></a>
                            <img src="./Asset/images/bg1.png" alt="BG" class="bg-img">
                            <div class="project-img">
                                <img src="./Asset/images/project6.jpeg" alt="Project">
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="project-info">
                                    <p>wEB DESIGNING</p>
                                    <h1>Hydra Merc</h1>
                                </div>
                                <a href="work-details.html" class="project-btn">
                                    <img src="./Asset/fonts/icon.svg" alt="Button">
                                </a>
                            </div>
                        </div>

                    </div>
                </div> 
            -->

            </div>

            <?php
                        $counter = 0;
                        $rowcount = mysqli_num_rows($blogData);
                        if($rowcount>0){
                            while($data = mysqli_fetch_assoc($blogData)){
                                if($counter%4 != 0 ){
                    ?>
            <div class="col-md-12">
                <div class="d-flex align-items-start gap-24">
                    <?php } ?>
                    <div class="col-md-4">
                        <div data-aos="zoom-in" class="flex-1">
                            <div class="project-item shadow-box">
                                <a class="overlay-link" href="?p=Showblog&blogID=<?php echo $data['id']; ?>"></a>
                                <img src="./Asset/images/bg1.png" alt="BG" class="bg-img">
                                <div class="project-img">
                                    <img src="./DB/<?php echo $data['id']; ?>/BannerData.jpg" alt="Project">
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
                    <?php if($counter%3 == 0){?>
                </div>
            </div>

            <?php
                        }
                                $counter++;
                            }
                        };
                    ?>

        </div>
    </div>
</section>