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
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add Slide</h4>
                                    <p class="card-description"> Enter Slide Information</p>
                                    <form class="forms-sample" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Title</label>
                                            <input type="text" class="form-control" id="exampleInputName1" name="title"
                                                placeholder="Enter your title">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Basic Text</label>
                                            <input type="text" class="form-control" id="exampleInputEmail3"
                                                name="textdesc" placeholder="Enter your text">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelectGender">Category</label>
                                            <select class="form-control" id="exampleSelectGender" name="categorylist">
                                                <option value="">Select Category</option>
                                                <?php
                        $query = "SELECT * FROM tbl_category order by category asc";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                          if (mysqli_num_rows($result) > 0) {
                            $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            foreach ($categories as $category) { ?>
                                                <option value="<?= $category['category'] ?>">
                                                    <?= $category['category'] ?></option>
                                                <?php }
                          } else {
                            echo "<option value=''>No Category Found</option>";
                          }
                        } else {
                          echo "<option  value=''>Error executing the query: " . mysqli_error($con) . "</option>";
                        }
                        ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Image upload</label>
                                            <input type="file" name="uploadimg" accept=".jpg, .png, .webp, .jpeg"
                                                class="file-upload-default myfilesiimg">
                                            <div class="input-group col-xs-12">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-gradient-light h-100"
                                                        onclick="document.querySelector('.myfilesiimg').click()"
                                                        type="button">Upload</button>
                                                </span>
                                                <input type="text" class="form-control file-upload-info" disabled
                                                    placeholder="Upload Image">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleTextarea1">Video Links</label>
                                            <textarea class="form-control" id="exampleTextarea1" name="videourl"
                                                rows="4"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-gradient-primary me-2"
                                            name="savebtn">Submit</button>
                                        <a href="slider.php" class="btn btn-light">Cancel</a>
                                    </form>
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

  $slide = $_FILES['uploadimg']['name'];
  $path = $_FILES['uploadimg']['tmp_name'];


  extract($_POST);
  if (empty($title)) {
    $errors[] = "Title is required.";
  }
  if (empty($textdesc)) {
    $errors[] = "Text description is required.";
  }
  // Validate book attachment
  if (isset($_FILES["uploadimg"]) && $_FILES["uploadimg"]["error"] === UPLOAD_ERR_OK) {
    $allowedExtensions = array("jpg", "png", "webp", "jpeg");
    $fileExtension = pathinfo($_FILES["uploadimg"]["name"], PATHINFO_EXTENSION);

    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
      $errors[] = "Only JPG/JPEG, PNG and Webp Images are allowed.";
    }
  } else {
    $errors[] = "Image upload is required.";
  }
  if (empty($categorylist)) {
    $errors[] = "Category is required.";
  }
  if (empty($videourl)) {
    $errors[] = "Video Url is required.";
  }

  if (empty($errors)) {
    if (move_uploaded_file($path, 'assets/uploads/img/' . $slide)) {
      $q = "insert into tbl_slider values(null,'$title','$textdesc','$slide','$categorylist','$videourl',0)";

      mysqli_query($con, $q);
      echo '<div class="myalert alert alert-success"> Slide details successfully added! </div>';
      echo "<script>location.href='slider.php';</script>";
    }
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