<?php
    $fileID = isset($_GET['fileID']) ? $_GET['fileID'] : '';

?>
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
                            <th scope="col" class="col-md-6">Folder Name</th>
                            <th scope="col">File Name</th>
                        </tr>
                    </thead>

                    <?php
                $fileData = GetFileDataByID($fileID);
                $FileID;
                if(mysqli_num_rows($fileData)>0){
                  while($data = mysqli_fetch_assoc($fileData)){
                ?>
                    <tbody class="table-group-divider">
                        <tr>
                            <td class="align-middle"><?php echo $data['id']; ?></td>
                            <td class="align-middle"><?php echo $data['folderName']; ?></td>
                            <td class="align-middle"><?php echo $data['fileName'];  ?></td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-primary btn-sm"> 
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm"> 
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <?php } } ?>
                </table>
            </div>
        </div>
    </div>
</main>
