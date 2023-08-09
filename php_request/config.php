<?php

// Creating connection with MySQL Databbase

$con = mysqli_connect('localhost', 'root', '', 'game_fixation');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
