<?php include("header.php"); ?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div>

  
        <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
  
        <div class="d-inline"><h2>All Blogs</h2></div>
        <div class="d-flex justify-content-end mb-3 d-inline">
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
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
                <th scope="col">Tag</th>
                <th scope="col">Edit</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <tr>
                <td class="align-middle">1000</td>
                <td class="align-middle" >this is the random data that mimic the header of a blog.this is the random data that mimic the</td>
                <td class="align-middle">22/22/2222</td>
                <td class="align-middle">camera camera</td>
                <td class="align-middle"> 
                  <button type="button" class="btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i></button> 
                  <button type="button" class="btn btn-danger btn-sm"> <i class="bi bi-trash3"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>
      </div>
      
        
    </main>

<?php include("footer.php"); ?>

