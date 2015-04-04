<?php

$db = mysqli_connect("localhost", "root", "", "y_hackathon");
mysqli_query($db, 'SET NAMES utf8');
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} 