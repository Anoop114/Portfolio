<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div>
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
                            <td class="align-middle"><?php echo $data['id']; ?></td>
                            <td class="align-middle"><?php echo $data['blog_name']; ?></td>
                            <td class="align-middle"><?php echo $data['created_time'];  ?></td>
                            <td class="align-middle"><?php echo $data['unity_scene'];  ?></td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#FileData"> <i class="bi bi-eye-fill"></i></button>
                                <button type="button" class="btn btn-danger btn-sm"> <i
                                        class="bi bi-trash3"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    <?php } } ?>
                </table>
            </div>
        </div>
    </div>
</main>

<main>
    <!-- Modal -->
    <div class="modal fade" id="FileData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <label for="formFile" class="form-label">Upload Image Files</label>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-7">
                                    <input class="form-control" type="file" name="uploadfile" multiple="multiple" />
                                </div>
                                <div class="col-md-5">
                                    <button class="btn btn-success" name="addFile">Upload</button>
                                    <div class="form-check-inline">
                                        <label class="form-check-label" for="inlineCheckbox1"> 1st</label>
                                        <input class="form-check-input form-check-inline" type="checkbox">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <div class="form-control">
                            <div class="table-responsive small">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">File Name</th>
                                            <th scope="col">Link</th>
                                            <th scope="col" class="text-center">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider DataHolder">
                                        <tr>
                                            <td>100</td>
                                            <td>abc.pic</td>
                                            <td>abc/123.xyz
                                                <button type="button" class="btn  btn-sm float-end "><i
                                                        class="bi bi-clipboard"></i></button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#ImageViewer"> <i
                                                        class="bi bi-eye-fill"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm"> <i
                                                        class="bi bi-trash3"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<main>
    <!-- Modal -->
    <div class="modal fade" id="ImageViewer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#FileData"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="./DB/9/Profile_Michael - Copy.jpg" class="img-fluid rounded" alt="Responsive image">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#FileData">Close</button>
                </div>
            </div>
        </div>
    </div>
</main>