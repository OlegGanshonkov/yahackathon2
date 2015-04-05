<?php

session_start();
require_once '../mysqlConnect.php';
require_once '../helper.php';


/*
 * CHANNELS list
 */
$rows = array();
$query = "SELECT * FROM channels";
$result = $db->query($query);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $rows[] = $row;
}
$channels = '';
foreach ($rows as $key => $item) {
    $channels .= "
	<div class='channel'>
            <a href='javascript: false;' >" . $item['title'] . "</a>	
	</div>
	";
}
$data['channels'] = $channels;


/*
 * MESSAGES
 */
if (isset($_POST['title'])) {
    $query = "SELECT * FROM channels WHERE title = '" . encode($_POST['title']) . "'";
    $result = $db->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $channel_id = $row['id'];

    $rows = array();
    $query = "SELECT * FROM channel_messages WHERE channel_id = '" . $channel_id . "' ORDER BY id DESC LIMIT 10";
    $result = $db->query($query);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $rows[] = $row;
    }
    sort($rows);
    
    $messages = '';
    foreach ($rows as $key => $item) {
        $messages .= "
	<div class='message'>
            " . htmlspecialchars_decode($item['message']) . "	
	</div>
	";
    }
}

$data['messages'] = $messages;


$data = json_encode($data);
echo $data;
die;

?>