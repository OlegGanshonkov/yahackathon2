<?php

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
    if (!empty($rows) && $rows[0]['password'] == $_POST['password']) {

        session_start();
        $_SESSION['user'] = $login;
        echo 1;
    } else {
        echo 2;
    }

    die;
}
echo 9;
?>