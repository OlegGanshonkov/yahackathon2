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
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $rows[] = $row;
    }
    if (!empty($rows)) {
        echo 2;
    } else {
        $query = "SELECT * FROM users WHERE login = '" . $_SESSION['user'] . "'";
        $result = $db->query($query);
        $author_id = $result->fetch_array(MYSQLI_ASSOC);
        $author_id = $author_id['id'];

        $query = "INSERT INTO channels(title, author_id) values('$title','$author_id')";
        $result = $db->query($query);
        if ($result) {
            echo 1;
        }
    };
    die;
}
echo 9;
?>