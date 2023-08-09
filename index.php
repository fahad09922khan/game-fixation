<?php include_once 'partial/_header.php'; ?>

<title>Game Fixation</title>

<body>
    <?php include_once 'partial/_menu.php'; ?>

    <section class="mainSlider" data-aos="fade-up">
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php
                $query = "SELECT * FROM tbl_slider order by id desc limit 3";
                $result = mysqli_query($con, $query);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        $slides = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        foreach ($slides as $slide) {
                ?>
                <div class="swiper-slide">
                    <img src="admin/assets/uploads/img/<?= $slide['image'] ?>" alt="">
                    <div class="container-fluid">
                        <div class="col-lg-11 mx-auto">
                            <span class="badge text-bg-primary"><?= $slide['category'] ?></span>
                            <h1 data-swiper-parallax="300" class="text-uppercase"><?= $slide['heading'] ?></h1>
                            <h5 data-swiper-parallax="200" class="text-uppercase"><?= $slide['text'] ?> </h5>
                            <a href="<?= $slide['url'] ?>" data-fancybox data-caption="<?= $slide['heading'] ?>"
                                class="btn btn-theme mt-5">Watch</a>
                        </div>
                    </div>
                </div>
                <?php }
                    } else {
                        ?>
                <div class="swiper-slide">
                    <img src="https://wallpapers.com/images/featured/tiswxpekr3su98uv.jpg" alt="">
                    <div class="container-fluid">
                        <div class="col-lg-11 mx-auto">
                            <h5 data-swiper-parallax="200" class="text-uppercase">No Data Found!</h5>
                        </div>
                    </div>
                </div>
                <?php    }
                } else {
                    ?>
                <div class="swiper-slide">
                    <img src="https://wallpapers.com/images/featured/tiswxpekr3su98uv.jpg" alt="">
                    <div class="container-fluid">
                        <div class="col-lg-11 mx-auto">
                            <h5 data-swiper-parallax="200" class="text-uppercase">Error executing the query:
                                <?= mysqli_error($con) ?></h5>
                        </div>
                    </div>
                </div>

                <?php   } ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="py-lg-5 py-md-4 py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row" data-aos="fade-up">
                        <div class="col">
                            <h1 class="heading">Videos</h1>
                        </div>
                        <div class="col-md-2 text-end">
                            <a href="videos.php" class="btn linkBtn">More <i class="fas fa-chevron-right fa-sm"></i></a>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up">
                        <?php
                        $query = "SELECT * FROM tbl_video order by id desc limit 3";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                $videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                foreach ($videos as $video) {
                        ?>
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="VideoWrapper">
                                <div class="overlay"></div>
                                <h6 class="mx-5"> No Videos found.</h6>

                            </div>
                        </div>
                        <?php  }
                        } else { ?>

                        <div class="col-md-4">
                            <div class="VideoWrapper">
                                <div class="overlay"></div>
                                <h6 class="mx-5"><?= mysqli_error($con) ?></h6>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="mt-5 mb-4" style="opacity: 0.25;" data-aos="fade-up">
                        <hr>
                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col">
                            <h1 class="heading">Reviews</h1>
                        </div>
                        <div class="col-md-2 text-end">
                            <a href="reviews.php" class="btn linkBtn">More <i
                                    class="fas fa-chevron-right fa-sm"></i></a>
                        </div>
                    </div>

                    <div class="swiper reviewSlider p-3 " data-aos="fade-up">
                        <div class="swiper-wrapper">
                            <?php
                            $query = "SELECT * FROM tbl_review where status=0 order by id desc";
                            $result = mysqli_query($con, $query);
                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    $count = 0;
                                    foreach ($reviews as $review) {
                                        $count++; ?>
                            <div class="swiper-slide">
                                <div class="newsWrapper card">
                                    <div class="card-body p-4">
                                        <h6 class="h6 mb-2 text-capitalize"><?= $review['username'] ?></h6>
                                        <span class="small text-capitalize"><?= $review['title'] ?></span>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span><?= $review['rating'] ?> / 10</span>
                                            <small class="text-warning"><i class="fas fa-star"></i><i
                                                    class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                    class="fas fa-star"></i><i class="fas fa-star"></i></small>
                                        </div>
                                        <p><q><?= $review['review'] ?></q></p>
                                    </div>
                                </div>
                            </div>
                            <?php }
                                } else { ?>
                            <div class="swiper-slide">
                                <div class="newsWrapper card">
                                    <div class="card-body p-4">
                                        <h6 class="h6 mb-1 text-capitalize">No Reviews.</h6>
                                        <span class="small text-capitalize">write your review</span>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span>0 / 10</span>
                                            <small class="text-warning"><i class="fas fa-star"></i><i
                                                    class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                    class="fas fa-star"></i><i class="fas fa-star"></i></small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php }
                            } else { ?>
                            <div class="swiper-slide">
                                <div class="newsWrapper card">
                                    <div class="card-body p-4">
                                        <h6 class="h6 mb-1 text-capitalize">No Reviews.</h6>
                                        <span class="small text-capitalize">write your review</span>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span>0 / 10</span>
                                            <small class="text-warning"><i class="fas fa-star"></i><i
                                                    class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                    class="fas fa-star"></i><i class="fas fa-star"></i></small>
                                        </div>
                                        <p>Error executing the query: <?= mysqli_error($con) ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row" data-aos="fade-up">
                        <div class="col">
                            <h1 class="heading">Top Rated</h1>
                        </div>
                        <div class="col text-end">
                            <a href="#" class="btn linkBtn"> <i class="fas fa-sort fa-sm"></i></a>
                        </div>
                    </div>
                    <ul class="topRatedList" data-aos="fade-up">
                        <?php
                        $query = "SELECT g.id as gid, g.title,g.screenshots as screenshots, AVG(r.rating) AS avg_rating FROM tbl_game g
                        INNER JOIN tbl_review r ON g.id = r.gameid
                        WHERE g.status = 0 AND r.status = 0 GROUP BY g.id ORDER BY avg_rating DESC LIMIT 5";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                $games = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                foreach ($games as $game) {
                        ?>
                        <li data-aos="fade-up">
                            <div class="ratedCard">
                                <figure>
                                    <img src="admin/<?= $game['screenshots'] ?>" class="img-fluid" alt="">
                                </figure>
                                <div>
                                    <a href="details.php?d=<?= $game['gid'] ?>" class="h6"><?= $game['title'] ?></a>
                                    <p class=" small"><i class="fas fa-star"></i><span
                                            class="ms-1"><?= $game['avg_rating'] ?></span></p>
                                </div>
                            </div>
                        </li>
                        <?php }
                            } else {
                                ?>
                        <li data-aos="fade-up">
                            <div class="ratedCard">
                                <figure>
                                    <img src="https://www.gamingdragons.co.il/images/game_img/screenshots/thecrew2/the_crew_2%20(2).jpg"
                                        alt="" class="img-fluid">
                                </figure>
                                <div class="card-body">
                                    <h6 class="h6">No games found</h6>
                                </div>
                            </div>
                        </li>
                        <?php  }
                        } else { ?>
                        <li data-aos="fade-up">
                            <div class="ratedCard">
                                <figure>
                                    <img src="https://www.gamingdragons.co.il/images/game_img/screenshots/thecrew2/the_crew_2%20(2).jpg"
                                        alt="" class="img-fluid">
                                </figure>
                                <div class="card-body">
                                    <h6 class="h6"><?= mysqli_error($con) ?></h6>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="mt-5 mb-4" style="opacity: 0.25;" data-aos="fade-up">
                <hr>
            </div>
            <div class="row" data-aos="fade-up">
                <div class="col">
                    <h1 class="heading">Latest Games</h1>
                </div>
                <div class="col-md-2 text-end">
                    <a href="games.php" class="btn linkBtn"><i class="fas fa-chevron-right fa-sm"></i></a>
                </div>
            </div>
            <div class="row" data-aos="fade-up">
                <?php
                $query = "SELECT * FROM tbl_game order by id desc limit 8";
                $result = mysqli_query($con, $query);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        $games = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        foreach ($games as $game) {
                ?>
                <div class="col-md-3">
                    <a href="details.php?d=<?= $game['id'] ?>" class="gameWrapper card">
                        <figure>
                            <img src="admin/<?= $game['screenshots'] ?>" alt="" class="img-fluid">
                        </figure>
                        <div class="card-body">
                            <h6 class="h6"><?= $game['title'] ?></h6>
                            <div class="d-flex align-items-start">
                                <div>
                                    <span class="small"><?= $game['publisher'] ?></span>
                                    <span class="rating">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </span>
                                </div>
                                <span class="btn btn-primary btn-sm ms-auto"><?= $game['category'] ?></span>
                            </div>

                        </div>
                    </a>
                </div>
                <?php }
                    } else {
                        ?>
                <div class="col-md-3">
                    <a class="gameWrapper card">
                        <figure>
                            <img src="https://www.gamingdragons.co.il/images/game_img/screenshots/thecrew2/the_crew_2%20(2).jpg"
                                alt="" class="img-fluid">
                        </figure>
                        <div class="card-body">
                            <h6 class="h6">No games found</h6>
                        </div>
                    </a>
                </div>
                <?php  }
                } else { ?>
                <div class="col-md-3">
                    <a class="gameWrapper card">
                        <figure>
                            <img src="https://www.gamingdragons.co.il/images/game_img/screenshots/thecrew2/the_crew_2%20(2).jpg"
                                alt="" class="img-fluid">
                        </figure>
                        <div class="card-body">
                            <h6 class="h6"><?= mysqli_error($con) ?></h6>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php include_once 'partial/_footer.php'; ?>