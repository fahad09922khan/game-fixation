<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">Game Fixation</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <!-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Platform
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        $query = "SELECT * FROM tbl_category order by category asc";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                $count = 0;
                                foreach ($categories as $category) {
                                    $count++; ?>
                        <li><a class="dropdown-item"
                                href="games.php?d=<?= $category['category'] ?>"><?= $category['category'] ?></a></li>
                        <?php }
                            } else {
                                echo '<li><a class="dropdown-item">No Platform Added!</a></li>';
                            }
                        } else {
                            echo '<li><a class="dropdown-item">Error executing the query:' . mysqli_error($con) . '</a></li>';
                        }
                        ?>
                    </ul>
                </li>
            </ul>
            <div class="mx-auto">
                <form action="search.php" method="GET" class="searchBox">
                    <input type="text" class="__input" name="s" placeholder="Search Here">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="d-flex moreNav align-items-center">
                <?php if (!isset($_SESSION['logined'])) { ?>
                <a href="signup.php" class="btn">Register</a>
                <span>|</span>
                <a href="login.php" class="btn">Login</a>
                <?php } else { ?>
                <a href="#" class="btn username">Hi! <span><?= $_SESSION['username'] ?></span>.</a>
                <a href="php_request/logout.php" class="btn logoutBtn">Logout</a>
                <?php   } ?>
            </div>
        </div>
    </div>
</nav>