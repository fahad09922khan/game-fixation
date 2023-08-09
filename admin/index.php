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
                <i class="mdi mdi-home"></i>
              </span> Dashboard
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                  <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Games <i class="mdi mdi-gamepad-variant mdi-24px float-right"></i>
                  </h4>
                  <?php
                  $query = "SELECT COUNT(*) as total_count FROM tbl_game";
                  $result = mysqli_query($con, $query);
                  if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $totalCount = $row['total_count'];
                  ?>
                    <h2 class='mb-5'><?= $totalCount < 10 ? '0' . $totalCount : $totalCount ?></h2>
                  <?php
                  } else {
                    echo "<h2 class='mb-5'>" . mysqli_error($conn) . "</h2>";
                  }
                  ?>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                  <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Reviews <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                  </h4>
                  <?php
                  $query = "SELECT COUNT(*) as total_count FROM tbl_review WHERE status = 0";
                  $result = mysqli_query($con, $query);
                  if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $totalCount = $row['total_count'];
                  ?>
                    <h2 class='mb-5'><?= $totalCount < 10 ? '0' . $totalCount : $totalCount ?></h2>
                  <?php
                  } else {
                    echo "<h2 class='mb-5'>" . mysqli_error($conn) . "</h2>";
                  }
                  ?>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                  <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Total Users <i class="mdi mdi-diamond mdi-24px float-right"></i>
                  </h4>
                  <?php
                  $query = "SELECT COUNT(*) as total_count FROM tbl_account WHERE role = 0";
                  $result = mysqli_query($con, $query);
                  if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $totalCount = $row['total_count']; ?>
                    <h2 class='mb-5'><?= $totalCount < 10 ? '0' . $totalCount : $totalCount ?></h2>
                  <?php } else {
                    echo "<h2 class='mb-5'>" . mysqli_error($conn) . "</h2>";
                  }
                  ?>

                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Latest Users</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Username </th>
                          <th> Email </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_account WHERE role = 0 order by id desc";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                          if (mysqli_num_rows($result) > 0) {
                            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            $count = 0;
                            foreach ($users as $user) {
                              $count++; ?>
                              <tr>
                                <td> <?= $count ?> </td>
                                <td style="text-transform: capitalize;">
                                  <img src="assets/images/user1.png" class="me-2" alt="image">
                                  <?= $user['username'] ?>
                                </td>
                                <td> <?= $user['email'] ?> </td>
                              </tr>
                        <?php }
                          } else {
                            echo "<tr><td colspan='3' class='text-center text-warning'>No users found.</td></tr>";
                          }
                        } else {
                          echo "<tr><td colspan='3' class='text-center text-warning'>Error executing the query: " . mysqli_error($con) . "</td></tr>";
                        }
                        ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4 class="card-title mb-0">All Comments</h4>
                    <a href="comments.php" class="btn btn-light px-3">More</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th width="30px"> # </th>
                          <th width="200px"> User </th>
                          <th> Comments </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_comment order by id desc limit 2";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                          if (mysqli_num_rows($result) > 0) {
                            $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            $count = 0;
                            foreach ($reviews as $review) {
                              $count++; ?>
                              <tr>
                                <td> <?= $count ?> </td>
                                <td style="text-transform: capitalize;">
                                  <p class="m-0"><?= $review['username'] ?></p>
                                  <small>
                                    <?= $review['title'] ?>
                                  </small>
                                </td>
                                <td> <?= $review['comment'] ?> </td>
                              </tr>
                        <?php }
                          } else {
                            echo "<tr><td colspan='5' class='text-center text-warning'>No category found</td></tr>";
                          }
                        } else {
                          echo "<tr><td colspan='5' class='text-center text-warning'>Error executing the query: " . mysqli_error($con) . "</td></tr>";
                        }
                        ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4 class="card-title">Reviews</h4>
                    <a href="reviews.php" class="btn btn-light px-3">More</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th width="20px"> # </th>
                          <!-- <th width="200px"> User </th> -->
                          <th> Review </th>
                          <th width="75px"> Rating </th>
                          <th width="80px"> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_review order by rating asc limit 2";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                          if (mysqli_num_rows($result) > 0) {
                            $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            $count = 0;
                            foreach ($reviews as $review) {
                              $count++; ?>
                              <tr>
                                <td> <?= $count ?> </td>
                                <!-- <td style="text-transform: capitalize;">
                                  <p class="m-0"><?= $review['username'] ?></p>
                                  <small>
                                    <?= $review['title'] ?>
                                  </small>
                                </td> -->
                                <td> <?= $review['review'] ?> </td>
                                <td class="text-center"> <?= $review['rating'] ?> </td>
                                <td class="text-end">
                                  <?php if ($review['status'] == 1) { ?>
                                    <label class="badge badge-light text-dark me-3">Hidden</label>
                                    <a href="php_request/delete.php?a=<?= $review['id'] ?>" class="btn btn-success btn-sm">
                                      <span class="mdi mdi-check"></span>
                                    </a>
                                  <?php } else { ?>
                                    <a href="php_request/delete.php?c=<?= $review['id'] ?>" class="btn btn-danger btn-sm">
                                      <span class="mdi mdi-close"></span>
                                    </a>
                                  <?php } ?>
                                </td>
                              </tr>
                        <?php }
                          } else {
                            echo "<tr><td colspan='5' class='text-center text-warning'>No category found</td></tr>";
                          }
                        } else {
                          echo "<tr><td colspan='5' class='text-center text-warning'>Error executing the query: " . mysqli_error($con) . "</td></tr>";
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