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
                                <i class="mdi mdi-gamepad-variant"></i>
                            </span> Video Game
                        </h3>
                        <a href="add-game.php" class="btn btn-inverse-primary btn-icon-text px-3"> <i
                                class="mdi mdi-upload btn-icon-prepend"></i> Add Games</a>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">All Games</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th> # </th>
                                                    <th> Details </th>
                                                    <th width="40px"> Description </th>
                                                    <th width="30px"> Images </th>
                                                    <th width="40px"> Setup </th>
                                                    <th width="50px"> Video URL </th>
                                                    <th width="40px"> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                        $query = "SELECT * FROM tbl_game order by id desc";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                          if (mysqli_num_rows($result) > 0) {
                            $games = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            $count = 0;
                            foreach ($games as $game) {
                              $count++; ?>
                                                <tr>
                                                    <td> <?= $count ?> </td>
                                                    <td>
                                                        <div>
                                                            <h5 class="mb-2"><?= $game['title'] ?></h5>
                                                            <div>
                                                                <span><?= $game['genre'] ?></span>
                                                            </div>
                                                            <div class="mt-2">
                                                                <span><?= $game['publisher'] ?></span>,
                                                                <span><?= $game['releaseDate'] ?></span>
                                                            </div>
                                                            <div class="mt-2">
                                                                <span>Multiplayer :
                                                                    <?= $game['multiplayerSupport'] ?></span>,
                                                                <span>Platform : <?= $game['category'] ?></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td> <a href="games-detail.php?de=<?= $game['id'] ?>">view</a> </td>
                                                    <td> <a href="<?= $game['screenshots'] ?>" target="_blank"><img
                                                                src="<?= $game['screenshots'] ?>" alt=""></a> </td>
                                                    <td> <a href="<?= $game['dLCsExpansions'] ?>" download
                                                            target="_blank">Setup</a></td>
                                                    <td> <a href="<?= $game['trailer'] ?>" target="_blank"
                                                            class="">Watch</a> </td>
                                                    <td>
                                                        <a href="php_request/delete.php?d=<?= $game['id'] ?>&t=tbl_game&r=games"
                                                            class="btn btn-sm btn-danger"><span
                                                                class="mdi mdi-delete"></span></a>
                                                    </td>
                                                </tr>
                                                <?php }
                          } else {
                            echo "<tr><td colspan='7' class='text-center text-warning'>No games found.</td></tr>";
                          }
                        } else {
                          echo "<tr><td colspan='7' class='text-center text-warning'>Error executing the query: " . mysqli_error($con) . "</td></tr>";
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