<?php

session_start();
require_once 'mysqlConnect.php';

function encode($var) {
    return $var;
}

//Добавление логина
if (isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['password']) && !empty($_POST['password'])) {
    $login = encode($_POST['login']);
    $password = encode($_POST['password']);

    // login check
    $rows = array();
    $query = "SELECT * FROM users WHERE login = '" . $_POST['login'] . "'";
    $result = $db->query($query);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $rows[] = $row;
    }
    if (!empty($rows)) {
        echo 2;
    } else {
        $query = "INSERT INTO users(login, password) values('$login','$password')";
        $result = $db->query($query);
        if ($result) {
            $_SESSION['user'] = $login;
            echo 1;
        }
    };
    die;
}
echo 9;
?>