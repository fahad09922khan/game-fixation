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
                                <i class="mdi mdi-video"></i>
                            </span> Videos
                        </h3>
                        <a href="add-video.php" class="btn btn-inverse-primary btn-icon-text px-3"> <i
                                class="mdi mdi-upload btn-icon-prepend"></i> Add Video</a>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">All Videos</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="80px"> # </th>
                                                    <th> Title </th>
                                                    <th width="100px"> Thumbnail </th>
                                                    <th width="100px"> Video </th>
                                                    <th width="100px"> Option </th>
                                                    <th width="70px"> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                        $query = "SELECT * FROM tbl_video order by id desc";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                          if (mysqli_num_rows($result) > 0) {
                            $videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            $count = 0;
                            foreach ($videos as $video) {
                              $count++; ?>
                                                <tr>
                                                    <td> <?= $count ?> </td>
                                                    <td> <?= $video['video'] ?> </td>
                                                    <td> <a href="assets/uploads/img/<?= $video['thumbnail']; ?>"
                                                            target="_blank"><img
                                                                src="assets/uploads/img/<?= $video['thumbnail']; ?>"
                                                                alt="<?= $video['video'] ?>"></a> </td>
                                                    <td> <a href="<?php if ($video['voption'] == 'Upload') {
                                                echo "assets/uploads/videos/" . $video['url'];
                                              } else {
                                                echo  $video['url'];
                                              } ?>" target="_blank">View</a> </td>
                                                    <td> <?= $video['voption'] ?> </td>
                                                    <td>

                                                        <a href="php_request/delete.php?d=<?= $video['id'] ?>&t=tbl_video&r=videos"
                                                            class="btn btn-sm btn-danger"><span class="mdi mdi-delete
"></span></a>
                                                    </td>
                                                </tr>
                                                <?php }
                          } else {
                            echo "<tr><td colspan='5' class='text-center text-warning'>No Videos found.</td></tr>";
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