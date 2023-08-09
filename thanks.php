<?php
include_once 'partial/_header.php';

?>

<title>Game Fixation</title>

<body>
    <?php include_once 'partial/_menu.php'; ?>

    <main class="contactmain" style="height:100vh; display:flex;align-items:center;">
        <div class="container">
            <div class="col-md-5 mx-auto" data-aos="fade-up">
                <figure>
                    <img src="assets/images/contact.png" class="img-fluid" alt="">
                </figure>
            </div>
            <div class="col-md-6 mx-auto text-center mt-5" data-aos="fade-up">
                <h1>Thanks You</h1>
                <p>We loved you talk.</p>
            </div>
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-theme">Back to Home</a>
            </div>
        </div>

    </main>
    <hr class="m-0">

    <?php include_once 'partial/_footer.php'; ?>

    <?php
    
    if(isset($_GET['d'])){
        $id=$_GET['d'];
        $query = "SELECT * FROM tbl_game where id=$id";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
        }
        $count=((int)$data['systemRequirements'])+1;
        $q="update tbl_game set systemRequirements='{$count}' where id=$id";
        if(mysqli_query($con,$q)){
            echo "<script>window.location.href='admin/{$data['dLCsExpansions']}';</script>";
        }
    }
    ?>