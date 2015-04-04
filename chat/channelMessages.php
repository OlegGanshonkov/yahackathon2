<?php

session_start();
require_once '../mysqlConnect.php';
require_once '../helper.php';

if (isset($_POST['title'])) {

    $query = "SELECT * FROM channels WHERE title = '" . $_POST['title'] . "'";
    $result = $db->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $channel_id = $row['id'];

    $rows = array();
    $query = "SELECT * FROM channel_messages WHERE channel_id = '" . $channel_id . "'";
    $result = $db->query($query);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $rows[] = $row;
    }
    foreach ($rows as $key => $item) {
        echo "
	<div class='message'>
            " . $item['message'] . "	
	</div>
	";
    }
}
?>