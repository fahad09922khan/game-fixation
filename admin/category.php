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
              </span> Main Category
            </h3>
            <form method="POST">
              <div class="form-group mb-0">
                <div class="input-group">
                  <?php
                  if (isset($_GET['e'])) {
                    $id = $_GET['e'];
                    $query = "SELECT * FROM tbl_category where id=$id";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                      $data = mysqli_fetch_assoc($result);
                      $categoryName = $data['category'];
                    } else {
                      $categoryName = "";
                    }
                  } else {
                    $categoryName = "";
                  }
                  ?>
                  <input type="text" class="form-control" name="categoryname" value="<?= $categoryName ?>" placeholder="Enter Category">
                  <div class="input-group-append">
                    <?php
                    if (isset($_GET['e'])) {
                      $button = "editbtn";
                    } else {
                      $button = "savebtn";
                    }
                    ?>
                    <button class="btn btn-inverse-primary h-100" name="<?= $button ?>" type="submit">Save</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All Categories</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th width="80px"> # </th>
                          <th> Cateory </th>
                          <th width="120px"> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $query = "SELECT * FROM tbl_category order by category asc";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                          if (mysqli_num_rows($result) > 0) {
                            $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            $count = 0;
                            foreach ($categories as $category) {
                              $count++; ?>
                              <tr>
                                <td> <?= $count ?> </td>
                                <td style="text-transform: capitalize;">
                                  <?= $category['category'] ?>
                                </td>
                                <td>
                                  <a href="category.php?e=<?= $category['id'] ?>" class="btn btn-sm"><span class="mdi mdi-lead-pencil"></span></a>
                                  <a href="php_request/delete.php?d=<?= $category['id'] ?>&t=tbl_category&r=category" class="btn btn-sm btn-danger"><span class="mdi mdi-delete"></span></a>
                                </td>
                              </tr>
                        <?php }
                          } else {
                            echo "<tr><td colspan='3' class='text-center text-warning'>No category found</td></tr>";
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