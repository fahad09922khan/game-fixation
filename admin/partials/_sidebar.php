<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="assets/images/user.png" alt="profile">
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2 username"><?= $_SESSION['username'] ?></span>
                    <span class="text-secondary text-small">Admin</span>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="games.php">
                <span class="menu-title">Games</span>
                <i class="mdi mdi-gamepad-variant menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="videos.php">
                <span class="menu-title">Videos</span>
                <i class="mdi mdi-video menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="category.php">
                <span class="menu-title">Platform</span>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="slider.php">
                <span class="menu-title">Slides</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="reviews.php">
                <span class="menu-title">Reviews</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="comments.php">
                <span class="menu-title">Comments</span>
                <i class="mdi mdi-message-processing menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="contact.php">
                <span class="menu-title">Contact</span>
                <i class="mdi mdi-account menu-icon"></i>
            </a>
        </li>
        <li class="nav-item sidebar-actions border-top">
            <button class="btn btn-block btn-lg w-100 btn-gradient-danger mt-3">Logout</button>
        </li>
    </ul>
</nav>