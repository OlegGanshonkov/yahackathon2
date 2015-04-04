<?php

session_start();
require_once '../mysqlConnect.php';
require_once '../helper.php';

$rows = array();
$query = "SELECT * FROM channels";
$result = $db->query($query);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $rows[] = $row;
}
foreach ($rows as $key => $item) {
    echo "
	<div class='channel'>
            <a href='javascript: false;' >" . $item['title'] . "</a>	
	</div>
	";
}
?>