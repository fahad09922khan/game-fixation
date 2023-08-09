

<?php
session_start();
include_once 'config.php';


$uname = $_SESSION['username'];
$uid = $_SESSION['userid'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    $commentMsg = mysqli_real_escape_string($con, $commentMsg);
    $q = "insert into tbl_comment values(null,'$id','$title','$commentMsg','$uname','$uid',0)";
    if (mysqli_query($con, $q)) {
        echo 1;
    }
}
