<?php
session_start();
include_once 'config.php';
$id = $_GET['q'];
$query = "SELECT * FROM tbl_comment where gameid=$id order by id desc";
$result = mysqli_query($con, $query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($comments as $coment) {
            echo '<div class="comment-item"><pre>' . $coment['comment'] . '</pre><p>By ' . $coment['username'] . '</p></div>';
        }
    } else {
        echo '<div class="comment-item"><pre>No Comments added.</pre><p>Be the First commenter</p></div>';
    }
} else {

    echo '<div class="comment-item"><pre>Error executing the query:' . mysqli_error($con) . '</pre></div>';
}
