<?php
    $fileID = isset($_GET['blogID']) ? $_GET['blogID'] : '';
    
    
    if($fileID == ''){
        $link = GetBlogDataByID('');
    }else{
        $link = GetBlogDataByID($fileID);
    }
    $data = mysqli_fetch_assoc($link);
    
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
                    <li><a href="https://anoop114.github.io/Portfolio/AboutFull.html">About</a></li>
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
                    if($data['gameUrl'] != ''){
                ?>
                <div class="d-md-flex justify-content-md-end">
                    <a href="<?php echo $data['gameUrl'];?>" class="theme-btn" target="_blank">Click to Play</a>
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
                            <img src="./DB/<?php echo $data['folderId']; ?>/BannerData.jpg" alt="Blog">
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