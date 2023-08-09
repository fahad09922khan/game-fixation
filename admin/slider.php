<?php include_once 'partials/_header.php'; ?>
<title>Game Fixation Admin</title>

<body>
  <div class="container-scroller">
    <!-- Navbar partial -->
    <?php include_once 'partials/_navbar.php'; ?>
    <!-- !Navbar partial -->

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

      <!-- _sidebar partial -->
      <?php include_once 'partials/_sidebar.php'; ?>
      <!-- _sidebar partial -->

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-format-list-bulleted"></i>
              </span> Main Slider
            </h3>
            <a href="add-slider.php" class="btn btn-inverse-primary btn-icon-text px-3"> <i class="mdi mdi-upload btn-icon-prepend"></i> Add Slider</a>
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All Slides</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Title </th>
                          <th> Text </th>
                          <th> Images </th>
                          <th> Category </th>
                          <th> Video URL </th>
                          <th width="40px"> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_slider order by id desc limit 3";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                          if (mysqli_num_rows($result) > 0) {
                            $slides = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            $count = 0;
                            foreach ($slides as $slide) {
                              $count++; ?>
                              <tr>
                                <td> <?= $count ?> </td>
                                <td> <?= $slide['heading'] ?> </td>
                                <td> <?= $slide['text'] ?> </td>
                                <td> <a href="assets/uploads/img/<?= $slide['image'] ?>" target="_blank"><img src="assets/uploads/img/<?= $slide['image'] ?>" alt=""></a> </td>
                                <td> <?= $slide['category'] ?> </td>
                                <td> <?= $slide['url'] ?> </td>
                                <td>
                                  <a href="php_request/delete.php?d=<?= $slide['id'] ?>&t=tbl_slider&r=slider" class="btn btn-sm btn-danger"><span class="mdi mdi-delete"></span></a>
                                </td>
                              </tr>
                        <?php }
                          } else {
                            echo "<tr><td colspan='7' class='text-center text-warning'>No Slides found.</td></tr>";
                          }
                        } else {
                          echo "<tr><td colspan='7' class='text-center text-warning'>Error executing the query: " . mysqli_error($con) . "</td></tr>";
                        }
                        ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->


        <!-- partial:partials/_footer.html -->
        <?php include_once 'partials/_footer.php'; ?>

</body>

</html>