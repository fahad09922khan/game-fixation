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
                                    <h4 class="card-title">Add Video</h4>
                                    <p class="card-description"> Enter Video Information</p>
                                    <form class="forms-sample" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Video Title</label>
                                            <input type="text" class="form-control" id="exampleInputName1" name="title"
                                                placeholder="Enter your title">
                                        </div>
                                        <div class="d-flex mb-3">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" checked
                                                        name="videoOption" id="videoOption1" value="Upload"
                                                        onclick="toggleOptions()"> Upload <i
                                                        class="input-helper"></i></label>
                                            </div>
                                            <div class="form-check ms-4">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="videoOption"
                                                        id="videoOption2" value="Youtube" onclick="toggleOptions()">
                                                    Youtube <i class="input-helper"></i></label>
                                            </div>
                                        </div>
                                        <div id="uploadOption">
                                            <div class="form-group">
                                                <label>Video upload</label>
                                                <input type="file" name="uploadvideo" accept=".mp4"
                                                    class="file-upload-default myfilesvideo">
                                                <div class="input-group col-xs-12">
                                                    <span class="input-group-append">
                                                        <button class="file-upload-browse btn btn-gradient-light h-100"
                                                            onclick="document.querySelector('.myfilesvideo').click()"
                                                            type="button">Upload</button>
                                                    </span>
                                                    <input type="text" class="form-control file-upload-info" disabled
                                                        placeholder="Upload Video">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="youtubeOption" style="display: none;">
                                            <div class="form-group">
                                                <label for="exampleTextarea1">Video Links</label>
                                                <textarea class="form-control" id="exampleTextarea1" name="videourl"
                                                    rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Thumbnail upload</label>
                                            <input type="file" name="uploadimg" accept=".jpg, .jpeg, .webp, .png"
                                                class="file-upload-default myfilesimg">
                                            <div class="input-group col-xs-12">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-gradient-light h-100"
                                                        onclick="document.querySelector('.myfilesimg').click()"
                                                        type="button">Upload</button>
                                                </span>
                                                <input type="text" class="form-control file-upload-info" disabled
                                                    placeholder="Upload img">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary me-2"
                                            name="savebtn">Submit</button>
                                        <a href="videos.php" class="btn btn-light">Cancel</a>
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
<script>
function toggleOptions() {
    var uploadOption = document.getElementById("uploadOption");
    var youtubeOption = document.getElementById("youtubeOption");
    var uploadRadio = document.getElementById("videoOption1");

    if (uploadRadio.checked) {
        uploadOption.style.display = "block";
        youtubeOption.style.display = "none";
    } else {
        uploadOption.style.display = "none";
        youtubeOption.style.display = "block";
    }
}
</script>


<?php
if (isset($_POST['savebtn'])) {
  extract($_POST);

  $errors = [];

  if (isset($videoOption)) {
    $allowedImageExtensions = array("jpg", "jpeg", "png", "webp");
    $thumbnail = $_FILES["uploadimg"];
    $thumbnailPath = $thumbnail["tmp_name"];
    $thumbnailName = $thumbnail["name"];

    if ($videoOption === 'Upload') {
      if (empty($title)) {
        $errors[] = "Title is required.";
      }
      if (isset($_FILES["uploadvideo"]) && $_FILES["uploadvideo"]["error"] === UPLOAD_ERR_OK) {
        $allowedVideoExtensions = array("mp4");
  
        $fileVideoExtension = pathinfo($_FILES["uploadvideo"]["name"], PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileVideoExtension), $allowedVideoExtensions)) {
          $errors[] = "Only mp4 Videos are allowed.";
        }
  
        if (!empty($thumbnail["name"])) {
          $fileImageExtension = pathinfo($thumbnail["name"], PATHINFO_EXTENSION);
          if (!in_array(strtolower($fileImageExtension), $allowedImageExtensions)) {
            $errors[] = "Invalid thumbnail image format. Only jpg, jpeg, png, and webp images are allowed.";
          }
        }
  
        if (empty($errors)) {
          $videoPath = $_FILES["uploadvideo"]["tmp_name"];
          $video = $_FILES["uploadvideo"]["name"];
         
  
          if (move_uploaded_file($videoPath, 'assets/uploads/videos/' . $video) && move_uploaded_file($thumbnailPath, 'assets/uploads/img/' . $thumbnailName)) {
            $q = "INSERT INTO tbl_video VALUES (null, '$title', '$video','$thumbnailName', '$videoOption', 0)";
            mysqli_query($con, $q);
            echo '<div class="myalert alert alert-success"> Video successfully uploaded! </div>';
            echo "<script>location.href='videos.php';</script>";
          } else {
            $errors[] = "Error uploading files. Please try again.";
          }
        }
      } else {
        $errors[] = "Video upload is required.";
      }
    } elseif ($videoOption === 'Youtube') {
      if (empty($title)) {
        $errors[] = "Title is required.";
      }
      if (empty($videourl)) {
        $errors[] = "Video Url is required.";
      }
      if (!empty($thumbnail["name"])) {
        $fileImageExtension = pathinfo($thumbnail["name"], PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileImageExtension), $allowedImageExtensions)) {
          $errors[] = "Invalid thumbnail image format. Only jpg, jpeg, png, and webp images are allowed.";
        }
      }
      if (empty($errors)) {
        if (move_uploaded_file($thumbnailPath, 'assets/uploads/img/' . $thumbnailName)) {
          $q = "INSERT INTO tbl_video VALUES (null, '$title', '$videourl','$thumbnailName', '$videoOption', 0)";
          mysqli_query($con, $q);
          echo '<div class="myalert alert alert-success"> Video successfully uploaded! </div>';
          echo "<script>location.href='videos.php';</script>";
        } else {
          $errors[] = "Error uploading files. Please try again.";
        }
        // $q = "INSERT INTO tbl_video VALUES (null, '$title', '$videourl', '$thumbnailName', '$videoOption', 0)";
        // mysqli_query($con, $q);
        // echo '<div class="myalert alert alert-success"> Video successfully added! </div>';
        // echo "<script>location.href='videos.php';</script>";
      }
    } else {
      $errors[] = "Video Option is required.";
    }
  }
  
  if (!empty($errors)) {
    echo '<div class="myalert alert alert-danger"><ul>';
    foreach ($errors as $error) {
      echo '<li>' . $error . '</li>';
    }
    echo '</ul></div>';
  }


  // $errors = [];


  // if (isset($videoOption)) {
  //   if ($videoOption === 'Upload') {
  //     if (empty($title)) {
  //       $errors[] = "Title is required.";
  //     }
  //     if (isset($_FILES["uploadvideo"]) && $_FILES["uploadvideo"]["error"] === UPLOAD_ERR_OK) {
  //       $allowedExtensions = array("mp4");
  //       $fileExtension = pathinfo($_FILES["uploadvideo"]["name"], PATHINFO_EXTENSION);
  //       if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
  //         $errors[] = "Only mp4 Videos are allowed.";
  //       } else {
  //         $path = $_FILES["uploadvideo"]["tmp_name"];
  //         $video = $_FILES["uploadvideo"]["name"];
  //         if (move_uploaded_file($path, 'assets/uploads/videos/' . $video)) {
  //           $q = "INSERT INTO tbl_video VALUES (null, '$title', '$video', '$videoOption', 0)";
  //           mysqli_query($con, $q);
  //           echo '<div class="myalert alert alert-success"> Video successfully uploaded! </div>';
  //           echo "<script>location.href='videos.php';</script>";
  //         }
  //       }
  //     } else {
  //       $errors[] = "Video upload is required.";
  //     }
  //   } elseif ($videoOption === 'Youtube') {
  //     if (empty($title)) {
  //       $errors[] = "Title is required.";
  //     }
  //     if (empty($videourl)) {
  //       $errors[] = "Video Url is required.";
  //     }
  //     if (empty($errors)) {
  //       $q = "INSERT INTO tbl_video VALUES (null, '$title', '$videourl', '$videoOption', 0)";
  //       mysqli_query($con, $q);
  //       echo '<div class="myalert alert alert-success"> Video successfully added! </div>';
  //       echo "<script>location.href='videos.php';</script>";
  //     }
  //   } else {
  //     $errors[] = "Video Option is required.";
  //   }
  // }
  // if (!empty($errors)) {
  //   echo '<div class="myalert alert alert-danger"><ul>';
  //   foreach ($errors as $error) {
  //     echo '<li>' . $error . '</li>';
  //   }
  //   echo '</ul></div>';
  // }
}
?>