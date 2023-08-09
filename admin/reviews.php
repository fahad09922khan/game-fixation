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
                <i class="mdi mdi-chart-bar"></i>
              </span> Site Review
            </h3>
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All Reviews</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th width="50px"> # </th>
                          <th width="200px"> User </th>
                          <th> Review </th>
                          <th width="75px"> Rating </th>
                          <th width="80px"> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_review order by id desc";
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


<?php
if (isset($_POST['savebtn'])) {

  extract($_POST);
  if (empty($categoryname)) {
    $errors[] = "Category is required.";
  }

  if (empty($errors)) {
    $q = "insert into tbl_category values(null,'$categoryname',0)";
    mysqli_query($con, $q);
    echo '<div class="myalert alert alert-success"> Category successfully added! </div>';
    echo "<script>location.href='category.php';</script>";
  } else {
    if (!empty($errors)) {
      echo '<div class="myalert alert alert-danger">
                <ul>';
      foreach ($errors as $error) {
        echo '<li>' . $error . '</li>';
      }
      echo '</ul>
            </div>';
    }
  }
}

if (isset($_POST['editbtn'])) {

  extract($_POST);
  if (empty($categoryname)) {
    $errors[] = "Category is required.";
  }

  if (empty($errors)) {
    $id = $_GET['e'];
    $q = "update tbl_category set category='$categoryname' where id=$id";
    mysqli_query($con, $q);
    echo '<div class="myalert alert alert-success"> Category successfully updated! </div>';
    echo "<script>location.href='category.php';</script>";
  } else {
    if (!empty($errors)) {
      echo '<div class="myalert alert alert-danger">
                <ul>';
      foreach ($errors as $error) {
        echo '<li>' . $error . '</li>';
      }
      echo '</ul>
            </div>';
    }
  }
}
?>