<?php include_once 'partials/_header.php'; ?>
<titlel>Game Fixation Admin</titlel>

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
                                    <h4 class="card-title">Add Game</h4>
                                    <p class="card-description"> Enter Game Information</p>
                                    <form class="forms-sample" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" name="title"
                                                        placeholder="Enter your title">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Genre</label>
                                                    <input type="text" class="form-control" name="genre"
                                                        placeholder="Action, Racing, Sport">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Release Date</label>
                                                    <input type="date" class="form-control" name="release"
                                                        placeholder="Enter your title">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Trailer Link</label>
                                                    <input type="text" class="form-control" name="trailer"
                                                        placeholder="https://">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Publisher</label>
                                                    <input type="text" class="form-control" name="publisher"
                                                        placeholder="Enter company name">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleSelectGender">Platform</label>
                                                    <select class="form-control" id="exampleSelectGender"
                                                        name="categorylist" style="height: 45px;">
                                                        <option value="0">Select Platform</option>
                                                        <?php
                            $query = "SELECT * FROM tbl_category order by category asc";
                            $result = mysqli_query($con, $query);
                            if ($result) {
                              if (mysqli_num_rows($result) > 0) {
                                $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                foreach ($categories as $category) { ?>
                                                        <option><?= $category['category'] ?></option>
                                                        <?php }
                              } else {
                                echo "<option value='0'>No Category Found</option>";
                              }
                            } else {
                              echo "<option  value='0'>Error executing the query: " . mysqli_error($con) . "</option>";
                            }
                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Multi Player</label>
                                                    <input type="text" class="form-control" name="multiplayer"
                                                        placeholder="Yes, No">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Game Description</label>
                                                    <textarea class="form-control" name="gamedesc" rows="8"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Game upload</label>
                                                    <input type="file" name="uploadgame" accept=".exe, .zip, .rar, .msi"
                                                        class="file-upload-default myfilesgame">
                                                    <div class="input-group col-xs-12">
                                                        <span class="input-group-append">
                                                            <button
                                                                class="file-upload-browse btn btn-gradient-light h-100"
                                                                onclick="document.querySelector('.myfilesgame').click()"
                                                                type="button">Upload</button>
                                                        </span>
                                                        <input type="text" class="form-control file-upload-info"
                                                            disabled placeholder="Upload Image">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Image upload</label>
                                                    <input type="file" name="uploadimg"
                                                        accept=".jpg, .png, .webp, .jpeg"
                                                        class="file-upload-default myfilesiimg">
                                                    <div class="input-group col-xs-12">
                                                        <span class="input-group-append">
                                                            <button
                                                                class="file-upload-browse btn btn-gradient-light h-100"
                                                                onclick="document.querySelector('.myfilesiimg').click()"
                                                                type="button">Upload</button>
                                                        </span>
                                                        <input type="text" class="form-control file-upload-info"
                                                            disabled placeholder="Upload Image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-gradient-primary me-2"
                                            name="savebtn">Submit</button>
                                        <a href="games.php" class="btn btn-light">Cancel</a>
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

  $uploadgame = $_FILES['uploadgame']['name'];
  $path = $_FILES['uploadgame']['tmp_name'];


  extract($_POST);
  function validateRequiredFields($fields)
  {
    $errors = array();

    foreach ($fields as $field) {
      if (empty($_POST[$field])) {
        $errors[] = ucfirst($field) . " is required.";
      }
    }
    return $errors;
  }

  function validateFileUpload($fileInputName, $allowedExtensions)
  {
    $errors = array();

    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]["error"] === UPLOAD_ERR_OK) {
      $fileExtension = pathinfo($_FILES[$fileInputName]["name"], PATHINFO_EXTENSION);

      if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        $errors[] = "Only " . implode("/", $allowedExtensions) . " files are allowed.";
      }
    } else {
      $errors[] = ucfirst($fileInputName) . " is required.";
    }

    return $errors;
  }

  $requiredFields = array('title', 'genre', 'release', 'trailer', 'publisher', 'multiplayer', 'gamedesc');
  $errors = validateRequiredFields($requiredFields);

  
  $allowedImgExtensions = array("jpg", "png", "webp", "jpeg");
  $allowedSetupExtensions = array("exe", "zip", "rar", "msi");

  $errors = array_merge($errors, validateFileUpload("uploadimg", $allowedImgExtensions));
  $errors = array_merge($errors, validateFileUpload("uploadgame", $allowedSetupExtensions));


//   if (empty($errors)) {
//     $imgPath = 'assets/uploads/img/' . $_FILES["uploadimg"]["name"];
//     if (move_uploaded_file($_FILES["uploadimg"]["tmp_name"], $imgPath)) {
//       $setupPath = 'assets/uploads/setup/' . $_FILES["uploadgame"]["name"];
//       if (move_uploaded_file($_FILES["uploadgame"]["tmp_name"], $setupPath)) {
//         $detail = mysqli_real_escape_string($con, $gamedesc);
//         $setupPath = mysqli_real_escape_string($con, $setupPath);
//         $imgPath = mysqli_real_escape_string($con, $imgPath);
//         $trailer = mysqli_real_escape_string($con, $trailer);
//         // echo $title.$genre.$release.$publisher.$categorylist.$detail.$multiplayer.$setupPath.$imgPath.$trailer;
//         $q = "insert into tbl_game values(null,'$title','$genre','$release','$publisher','$categorylist','$detail','$multiplayer','$setupPath','0','$imgPath','$trailer',0)";
//         mysqli_query($con, $q);
//         echo '<div class="myalert alert alert-success"> Game details successfully added! </div>';
//         echo "<script>location.href='games.php';</script>";
        
//       } else {
//         $errors[] = "Failed to upload the setup file.";
//       }
//     } else {
//       $errors[] = "Failed to upload the image.";
//     }
//   }

try {
    if (empty($errors)) {
      $imgPath = 'assets/uploads/img/' . $_FILES["uploadimg"]["name"];
      if (move_uploaded_file($_FILES["uploadimg"]["tmp_name"], $imgPath)) {
        $setupPath = 'assets/uploads/setup/' . $_FILES["uploadgame"]["name"];
        if (move_uploaded_file($_FILES["uploadgame"]["tmp_name"], $setupPath)) {
          $detail = mysqli_real_escape_string($con, $gamedesc);
          $title = mysqli_real_escape_string($con, $title);
          $setupPath = mysqli_real_escape_string($con, $setupPath);
          $imgPath = mysqli_real_escape_string($con, $imgPath);
          $trailer = mysqli_real_escape_string($con, $trailer);

          $q = "insert into tbl_game values(null,'$title','$genre','$release','$publisher','$categorylist','$detail','$multiplayer','$setupPath','0','$imgPath','$trailer',0)";

          if (mysqli_query($con, $q)) {
            echo '<div class="myalert alert alert-success"> Game details successfully added! </div>';
            echo "<script>location.href='games.php';</script>";
          } else {
            throw new Exception("Failed to insert data into the database.");
          }
        } else {
          throw new Exception("Failed to upload the setup file.");
        }
      } else {
        throw new Exception("Failed to upload the image.");
      }
    }
  } catch (Exception $e) {
    $errors[] = $e->getMessage();
  }

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
?>