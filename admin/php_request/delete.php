<?php
include_once '../../php_request/config.php';
echo "please wait...";
if (isset($_GET['d']) && isset($_GET['t'])) {
    $id = $_GET['d'];
    $table = $_GET['t'];

    $q = "delete from $table where id=$id";
    if (mysqli_query($con, $q)) {
        if ($_GET['r']) {
            $r = $_GET['r'];
            echo "<script>location.href='../{$r}.php';</script>";
        } else {
            echo "<script>location.href='../index.php';</script>";
        }
    }
}

if (isset($_GET['a'])) {
    $id = $_GET['a'];
    $q = "update tbl_review set status=0 where id=$id";
    if (mysqli_query($con, $q)) {
        echo "<script>location.href='../reviews.php';</script>";
    }
}
if (isset($_GET['c'])) {
    $id = $_GET['c'];
    $q = "update tbl_review set status=1 where id=$id";
    if (mysqli_query($con, $q)) {
        echo "<script>location.href='../reviews.php';</script>";
    }
}
