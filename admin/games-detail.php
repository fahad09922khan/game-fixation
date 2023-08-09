<?php include_once 'partials/_header.php'; ?>
<title>Game Fixation Admin</title>
<?php

if (!isset($_GET['de'])) {
  echo "<script>location.href='games.php';</script>";
}


?>

<style>
  pre {
    font-family: "ubuntu-regular", sans-serif;
    padding: 0;
    white-space: break-spaces;
    line-height: 1.5;
    font-size: .9375rem;
  }
</style>

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
                <i class="mdi mdi-gamepad-variant"></i>
              </span> Video Game
            </h3>
            <a href="games.php" class="btn btn-inverse-primary btn-icon-text px-3">Back to Games</a>
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <?php
                  if (isset($_GET['de'])) {
                    $id = $_GET['de'];
                    $query = "SELECT * FROM tbl_game where id=$id";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                      $data = mysqli_fetch_assoc($result);
                      echo "<h4 class='card-title'>{$data['title']}</h4>";
                      echo "<pre>{$data['description']}</pre>";
                    }
                  }
                  ?>
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