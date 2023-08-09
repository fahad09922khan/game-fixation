<?php include_once 'partial/_header.php';

if (isset($_GET['d'])) {
    $search = $_GET['d'];
} else {

    $search = "All";
}

?>

<title>Game Fixation</title>

<body>
    <?php include_once 'partial/_menu.php'; ?>

    <section class="pagetitle" data-aos="fade-up">
        <h2 class="text-center">All Game Reviews</h2>
    </section>


    <section class="py-lg-5 py-md-4 py-3">
        <div class="container">
            <div class="row" data-aos="fade-up">
                <div class="col">
                    <h1 class="heading">Reviews</h1>
                </div>
            </div>
            <div class="row">
                <?php
                            $query = "SELECT * FROM tbl_review where status=0 order by id desc";
                            $result = mysqli_query($con, $query);
                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    $count = 0;
                                    foreach ($reviews as $review) {
                                        $count++; ?>
                <div class="col-md-3" data-aos="fade-up">
                    <div class="newsWrapper card">
                        <div class="card-body p-4">
                            <h6 class="h6 mb-2 text-capitalize"><?= $review['username'] ?></h6>
                            <span class="small text-capitalize"><?= $review['title'] ?></span>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span><?= $review['rating'] ?> / 10</span>
                                <small class="text-warning"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i></small>
                            </div>
                            <p><q><?= $review['review'] ?></q></p>
                        </div>
                    </div>
                </div>
                <?php }
                                } else { ?>
                <div class="col-md-3" data-aos="fade-up">
                    <div class="newsWrapper card">
                        <div class="card-body p-4">
                            <h6 class="h6 mb-1 text-capitalize">No Reviews.</h6>
                            <span class="small text-capitalize">write your review</span>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>0 / 10</span>
                                <small class="text-warning"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i></small>
                            </div>
                        </div>
                    </div>
                </div>

                <?php }
                            } else { ?>
                <div class="col-md-3" data-aos="fade-up">
                    <div class="newsWrapper card">
                        <div class="card-body p-4">
                            <h6 class="h6 mb-1 text-capitalize">No Reviews.</h6>
                            <span class="small text-capitalize">write your review</span>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span>0 / 10</span>
                                <small class="text-warning"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i></small>
                            </div>
                            <p>Error executing the query: <?= mysqli_error($con) ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="mt-5 mb-4" style="opacity: 0.25;" data-aos="fade-up">
                <hr>
            </div>
            <div class="row" data-aos="fade-up">
                <div class="col">
                    <h1 class="heading">Videos</h1>
                </div>
                <div class="col-md-2 text-end">
                    <a href="videos.php" class="btn linkBtn">More <i class="fas fa-chevron-right fa-sm"></i></a>
                </div>
            </div>
            <div class="row">
                <?php
                        $query = "SELECT * FROM tbl_video order by id desc limit 3";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                $videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                foreach ($videos as $video) {
                        ?>
                <div class="col-md-4" data-aos="fade-up">
                    <div class="VideoWrapper">
                        <img src="admin/assets/uploads/img/<?= $video['thumbnail']; ?>" alt="">
                        <div class="overlay"></div>
                        <a href="<?php if ($video['voption'] == 'Upload') {
                                                            echo "admin/assets/uploads/videos/" . $video['url'];
                                                        } else {
                                                            echo  $video['url'];
                                                        } ?>" data-fancybox data-caption="<?= $video['video'] ?>"
                            class="iconBox">
                            <i class="fas fa-play"></i>
                        </a>
                    </div>
                </div>

                <?php }
                            } else { ?>
                <div class="col-md-4" data-aos="fade-up">
                    <div class="VideoWrapper">
                        <div class="overlay"></div>
                        <h6 class="mx-5"> No Videos found.</h6>

                    </div>
                </div>
                <?php  }
                        } else { ?>

                <div class="col-md-4" data-aos="fade-up">
                    <div class="VideoWrapper">
                        <div class="overlay"></div>
                        <h6 class="mx-5"><?= mysqli_error($con) ?></h6>
                    </div>
                </div>
                <?php
                        }
                        ?>
            </div>

        </div>
    </section>


    <?php include_once 'partial/_footer.php'; ?>