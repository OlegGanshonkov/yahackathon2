<?php

session_start();
require_once '../mysqlConnect.php';
require_once '../helper.php';

//Добавление логина
if (isset($_POST['title']) && !empty($_POST['title'])) {
    $title = encode($_POST['title']);

    // title check
    $rows = array();
    $query = "SELECT * FROM channels WHERE title = '" . $_POST['title'] . "'";
    $result = $db->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    
    if (!empty($rows)) {
        echo 0;
    } else {
        echo $_POST['title'];
    };
    die;
}
echo 0;
?>