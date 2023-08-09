<?php 
    $blogData;
    if (isset($_GET['SearchData'])){
        $blogData = GetBlogByData($_GET['SearchData']);
    }else{
        $blogData = GetBlogData();
    }
?>


<!-- Header -->
<header class="header-area">
    <div class="container">
        <div class="gx-row d-flex align-items-center justify-content-between">
            <a href="https://anoop114.github.io/Portfolio/" class="logo">
                <img src="./Asset/images/logo.jpeg" alt="Logo">
            </a>

            <nav class="navbar">
                <ul class="menu">
                    <li><a href="https://anoop114.github.io/Portfolio/">Home</a></li>
                    <li><a href="https://anoop114.github.io/Portfolio/About.html">About</a></li>
                    <li class="active"><a href="?p=work">Works</a></li>
                    <li><a href="?p=cont">Contact</a></li>
                </ul>
                <a href="?p=cont" class="theme-btn">Let's talk</a>
            </nav>

            <a href="?p=cont" class="theme-btn">Let's talk</a>

            <div onclick="myFun()" class="show-menu" id="navCloser">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</header>
<!-- Projects -->
<section class="projects-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="section-heading" data-aos="fade-up"><img src="./Asset/images/star-2.png" alt="Star"> All
                    Projects <img src="./Asset/images/star-2.png" alt="Star"></h1>
            </div>
            <div class="container">
                <div class="col-md-4" style="float: right !important;">
                    <div class="blog-sidebar">
                        <div class="blog-sidebar-inner">
                            <div class="blog-sidebar-widget search-widget">
                                <div class="blog-sidebar-widget-inner" data-aos="zoom-in">
                                    <form method="GET" class="shadow-box">
                                        <input name="SearchData" type="text" placeholder="Search Here...">
                                        <button class="theme-btn">Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                            <img src="./DB/<?php echo $data['id']; ?>/BannerData.jpg" alt="Project"
                                style="max-height: 250px;height: 100%;  max-width: 250px; width: 100%;">
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
                        }else{
                            ?>
            <div class="container">
                <div class="project-info" style="text-align: center;">
                    <h1>There is nothing that you are searching. <br> Try to search other things.</h1>
                </div>
            </div>
            <?php
                        }
                    ?>
        </div>
    </div>
</section>