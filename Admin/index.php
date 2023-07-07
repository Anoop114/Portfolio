    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div>


        <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

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
                    <button type="button" class="btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i></button>
                    <button type="button" class="btn btn-danger btn-sm"> <i class="bi bi-trash3"></i></button>
                  </td>
                </tr>
              </tbody>

              <?php
      }
    }
    
?>



            </table>
          </div>
        </div>
      </div>




    </main>