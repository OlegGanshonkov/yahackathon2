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
	<li class=' channel '>
            <a class='channel_name'>
                <span class='overflow_ellipsis'>										
                    <span class='prefix'>#</span> <i>" . $item['title'] . "</i>
                </span>
            </a>
        </li>
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
    $query = "SELECT cm.*, u.login FROM channel_messages cm LEFT JOIN users u ON u.id = cm.author_id WHERE channel_id = '" . $channel_id . "' ORDER BY cm.id DESC LIMIT 100";
    $result = $db->query($query);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $rows[] = $row;
    }
    sort($rows);

    $messages = '';
    foreach ($rows as $key => $item) {
        if ($key % 2 == 0) {
            $img = 'images/ava.jpg';
        } else {
            $img = 'images/ava-2.png';
        }

        $messages .= '  
        <div class = "message">
            <div class = "chat-ava">
                <a href = "#" class = "member_preview_link member_image thumb_36" style = "background-image: url(\'' . $img . '\')"></a>
            </div>
            <div class = "chat-text">
                <span class = "chat-user-name">' . $item['login'] . '</span>
                <span class = "message_content">
                    ' . htmlspecialchars_decode($item['message']) . ' 
                </span>
            </div>
        </div>
        ';
    }
}

$data['messages'] = $messages;

/*
 * RSS
 */
if (isset($_POST['title'])) {
    $query = "SELECT * FROM channels WHERE title = '" . encode($_POST['title']) . "'";
    $result = $db->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $channel_id = $row['id'];

    $rows = array();
    $query = "SELECT * FROM rss WHERE channel_id = '" . $channel_id . "'";
    $result = $db->query($query);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $rows[] = $row;
    }

    $rss = '';
    foreach ($rows as $key => $item) {
        $rss .= "
	<div class='rss'>
            " . htmlspecialchars_decode($item['url']) . "	
	</div>
	";
    }
}

$data['rss'] = $rss;

$data = json_encode($data);
echo $data;
die;
?>