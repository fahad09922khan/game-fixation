<?php
include_once 'partial/_header.php';

if (!isset($_GET['d'])) {
    echo "<script>location.href='index.php';</script>";
}

?>

<title>Game Fixation</title>
<style>
.account__button {
    width: fit-content !important;
    margin-left: auto;
}

.star-rating {
    display: inline-block;
    font-size: 24px;
    cursor: pointer;
}

.star-rating span {
    color: gold;
}
</style>

<body>
    <?php include_once 'partial/_menu.php'; ?>

    <main class="mainwrapper pb-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php
                    $id = $_GET['d'];
                    $query = "SELECT * FROM tbl_game where id=$id";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $data = mysqli_fetch_assoc($result);
                    }
                    $query = "SELECT AVG(rating) AS average FROM tbl_review where gameid=$id";
                    $result = mysqli_query($con, $query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="card card-body details">
                        <?php
                        $youtubeShareLink = $data['trailer'];

                        function getYouTubeVideoID($url)
                        {
                            $video_id = "";
                            $url_parts = parse_url($url);
                            if (isset($url_parts['host']) && $url_parts['host'] === 'youtu.be') {
                                $video_id = ltrim($url_parts['path'], '/');
                            } elseif (isset($url_parts['query'])) {
                                parse_str($url_parts['query'], $query);
                                if (isset($query['v'])) {
                                    $video_id = $query['v'];
                                }
                            }
                            return $video_id;
                        }

                        $videoID = getYouTubeVideoID($youtubeShareLink);
                        if ($videoID) {
                            $embedURL = "https://www.youtube.com/embed/" . $videoID;
                            echo '<iframe width="100%" height="500" src="' . $embedURL . '" frameborder="0" allowfullscreen></iframe>';
                        }
                        else{
                            echo '<video src="'.$data['trailer'].'" controls></video>';
                        }
                        ?>
                        <div class="detail-heading">
                            <div>
                                <span class="btn btn-primary btn-sm" data-aos="fade-up"><?= $data['category'] ?></span>
                                <h2 class="mt-4" data-aos="fade-up"><?= $data['title'] ?></h2>
                                <div class="d-flex align-items-center" data-aos="fade-up">
                                    <small>By Admin</small> <span class="mx-2">.</span> <small
                                        class=""><?= $data['publisher'] ?></small> <span class="mx-2">.</span> <small
                                        class=""><?= $data['releaseDate'] ?></small>
                                </div>
                                <span class="rating mt-2 mb-3 d-block">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <span><?= $row['average'] ?></span>
                                </span>
                                <div class="d-flex pb-3">
                                    <a href="thanks.php?d=<?=$data['id']?>"
                                        class="btn btn-outline-primary rounded-5 py-2 px-3">Download Game</a>
                                </div>
                            </div>
                            <figure data-aos="fade-left">
                                <img src="admin/<?= $data['screenshots'] ?>" class="img-fluid" alt="">
                            </figure>
                        </div>
                    </div>
                    <div class="mt-5 mb-4" style="opacity: 0.25;">
                        <hr>
                    </div>
                    <div class="card card-body details pt-5">
                        <div class="row mx-5">
                            <div class="col-md-4 mt-3" data-aos="fade-up">
                                <small class="text-muted">Publisher</small>
                                <p><?= $data['publisher'] ?></p>
                            </div>
                            <div class="col-md-4 mt-3" data-aos="fade-up">
                                <small class="text-muted">Release Date</small>
                                <p><?= $data['releaseDate'] ?></p>
                            </div>
                            <div class="col-md-4 mt-3" data-aos="fade-up">
                                <small class="text-muted">Tags</small>
                                <p><?= $data['category'] ?></p>
                            </div>
                            <div class="col-md-4 mt-3" data-aos="fade-up">
                                <small class="text-muted">Platform</small>
                                <p><?= $data['category'] ?></p>
                            </div>
                            <div class="col-md-4 mt-3" data-aos="fade-up">
                                <small class="text-muted">Multiplayer</small>
                                <p><?= $data['multiplayerSupport'] ?></p>
                            </div>
                            <div class="col-md-4 mt-3" data-aos="fade-up">
                                <small class="text-muted">Downloads</small>
                                <p><?= $data['systemRequirements'] ?></p>
                            </div>
                        </div>
                        <div class="mt-3 mb-4" style="opacity: 0.25;" data-aos="fade-up">
                            <hr>
                        </div>
                        <h4 class="card-title mx-5 mb-0" data-aos="fade-up">About this Game</h4>
                        <pre data-aos="fade-up"><?= $data['description'] ?></pre>
                    </div>
                    <div class="separtor"></div>
                    <div class="row align-items-center" data-aos="fade-up">
                        <div class="col mb-lg-4 mb-md-4 mb-3">
                            <h1 class="heading mb-0">Rating</h1>
                        </div>
                        <div class="col-lg-3 col-md-4 col-5  mb-lg-4 mb-md-4 mb-3 text-end">
                            <?php if (isset($_SESSION['logined'])) { ?>
                            <a href="#" class="btn btn-theme text-white" data-bs-toggle="modal"
                                data-bs-target="#ratingModal">Add Rating</a>
                            <?php } else { ?>
                            <a href="login.php?return=details.php?d=<?= $id ?>"
                                class="btn btn-theme text-white">Login</a>
                            <?php   } ?>
                        </div>
                    </div>
                    <div class="swiper reviewSlider p-3 " data-aos="fade-up">
                        <div class="swiper-wrapper">
                            <?php
                            $query = "SELECT * FROM tbl_review where gameid=$id and status=0 order by id desc";
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
                    <div class="row video-details mb-4">
                        <?php
                        $query = "SELECT * FROM tbl_video order by id desc limit 3";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                $videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                foreach ($videos as $video) {
                        ?>
                        <div class="col-md-12">
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
                        <div class="col-md-12">
                            <div class="VideoWrapper">
                                <div class="overlay"></div>
                                <h6 class="mx-5"> No Videos found.</h6>

                            </div>
                        </div>
                        <?php  }
                        } else { ?>

                        <div class="col-md-12">
                            <div class="VideoWrapper">
                                <div class="overlay"></div>
                                <h6 class="mx-5"><?= mysqli_error($con) ?></h6>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="commentBox">
                        <div class="messageBox">
                            <?php if (isset($_SESSION['logined'])) { ?>
                            <form method="POST">
                                <input type="text" class="__input" name="commentMsg" placeholder="Enter your comment">
                                <button class="btn sendBtn" name="sendBtn"><i class="fas fa-paper-plane"></i></button>
                            </form>
                            <?php } else {
                                echo "<p class='text-white mb-0'>Login First to comment.</p>";
                            } ?>
                        </div>
                        <div class="commentList">
                            <?php
                            $query = "SELECT * FROM tbl_comment where gameid=$id order by id desc";
                            $result = mysqli_query($con, $query);
                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    foreach ($comments as $coment) {
                                        echo '<div class="comment-item">
                                <pre>' . $coment['comment'] . '</pre>
                                <p>By ' . $coment['username'] . '</p>
                            </div>';
                                    }
                                } else {
                                    echo '<div class="comment-item">
                                <pre>No Comments added.</pre>
                                <p>Be the First commenter</p>
                            </div>';
                                }
                            } else {

                                echo '<div class="comment-item">
                                <pre>Error executing the query:' . mysqli_error($con) . '</pre>
                            </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>


    <!-- Modal -->
    <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="ratingModalLabel">Write a Review</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="account__form">
                        <div>
                            <form class="account__fields" id="signin" method="POST">
                                <div class="input-wrapper">
                                    <label class="account__label" for="rating">Rating</label>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="star-rating">
                                            <span class="fa-regular fa-star" data-star="1" data-rating="2.1"></span>
                                            <span class="fa-regular fa-star" data-star="2" data-rating="4.3"></span>
                                            <span class="fa-regular fa-star" data-star="3" data-rating="6.5"></span>
                                            <span class="fa-regular fa-star" data-star="4" data-rating="8.7"></span>
                                            <span class="fa-regular fa-star" data-star="5" data-rating="9.8"></span>
                                            <input type="hidden" name="rating" id="rating" required value="2.5">
                                        </div>
                                        <h4 class="mb-0" id="rating1">0.0</h4>
                                    </div>
                                </div>
                                <div class="input-wrapper">
                                    <label class="account__label" for="review">Your Review</label>
                                    <textarea class="__input" id="review" name="review" required rows="8"></textarea>
                                </div>
                                <button class="account__button" name="savebtn" type="submit">Submit Review</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include_once 'partial/_footer.php'; ?>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star-rating span');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                const selectedStar = parseInt(this.getAttribute("data-star"));
                document.querySelector('.star-rating input').value = rating;
                document.querySelector('#rating1').textContent = rating;
                for (let i = 0; i < stars.length; i++) {
                    if (i < selectedStar) {
                        stars[i].classList.add('fa-solid');
                    } else {
                        stars[i].classList.remove('fa-solid');
                    }
                }
                console.log(rating);
            });
        });
    });
    </script>


    <?php
if (isset($_SESSION['logined'])) {
    $title = mysqli_real_escape_string($con, $data['title']);
    $uname = $_SESSION['username'];
    $uid = $_SESSION['userid'];

    if (isset($_POST['savebtn'])) {
        extract($_POST);
        if (empty($review)) {
            $errors[] = "Review is required.";
        }

        if (empty($errors)) {
            $rating = mysqli_real_escape_string($con, $rating);
            $review = mysqli_real_escape_string($con, $review);

            $q = "insert into tbl_review values(null,'$id','$title','$rating','$review','$uname',0)";
            if (mysqli_query($con, $q)) {
                echo '<div class="myalert alert alert-success"> Review successfully added! </div>';
                echo "<script>location.href='details.php?d={$id}';</script>";
            }
        } else {
            if (!empty($errors)) {
                echo '<div class="myalert alert alert-danger"><ul>';
                foreach ($errors as $error) {
                    echo '<li>' . $error . '</li>';
                }
                echo '</ul></div>';
            }
        }
    }

    if (isset($_POST["sendBtn"])) {
        extract($_POST);
        $commentMsg = mysqli_real_escape_string($con, $commentMsg);
        $q = "insert into tbl_comment values(null,'$id','$title','$commentMsg','$uname','$uid',0)";
        if (mysqli_query($con, $q)) {
            echo '<div class="myalert alert alert-success"> Commment successfully added! </div>';
            echo "<script>location.href='details.php?d={$id}';</script>";
        }
    }
}
?>