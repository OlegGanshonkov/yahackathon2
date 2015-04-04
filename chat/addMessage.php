<?php

session_start();
require_once '../mysqlConnect.php';
require_once '../helper.php';


if (isset($_POST['message']) && !empty($_POST['message']) && isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['title']) && !empty($_POST['title'])) {
    $message = encode($_POST['message']);

    $query = "SELECT * FROM users WHERE login = '" . $_POST['login'] . "'";
    $result = $db->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $author_id = $row['id'];

    $query = "SELECT * FROM channels WHERE title = '" . $_POST['title'] . "'";
    $result = $db->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $channel_id = $row['id'];

    $query = "INSERT INTO channel_messages(author_id, message, channel_id) values('$author_id','$message', '$channel_id')";
    $result = $db->query($query);
    if ($result) {
        echo 1;
    }

    die;
}
echo 9;
?>