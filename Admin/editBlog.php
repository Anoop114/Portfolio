<?php include("header.php"); ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!--Form Start-->
    <section class="my-3 form-control">
        <h2>New Post</h2>
        <div class="my-3">
            <label for="Title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Title of blog">
        </div>
        <div class="my-3">
            <label for="Title" class="form-label">Tag</label>
            <input type="text" class="form-control" id="title" placeholder="Tag of blog">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Choose Image</label>
            <input class="form-control" type="file" id="formFile">
        </div>
        <img src="https://cdn.pixabay.com/photo/2016/11/29/04/19/ocean-1867285__340.jpg"
            class="img-fluid mx-auto d-block  my-3" alt="...">
        <div class="mb-3">
            <label for="formFile" class="form-label">Add Files</label>
            <input class="form-control" type="file" id="formFile">
        </div>

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
                    <tbody class="table-group-divider">
                        <tr>
                            <td>100</td>
                            <td>abc.pic</td>
                            <td>abc/123.xyz
                                <button type="button" class="btn  btn-sm float-end "><i class="bi bi-clipboard"></i></button>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success btn-sm"> <i
                                        class="bi bi-pencil-square"></i></button>
                                <button type="button" class="btn btn-danger btn-sm"> <i
                                        class="bi bi-trash3"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--Form End-->
    <?php include("addBlog.php"); ?>


</main>




<?php include("footer.php"); ?>