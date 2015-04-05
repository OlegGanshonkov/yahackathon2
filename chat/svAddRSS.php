<?php

session_start();
require_once '../mysqlConnect.php';
require_once '../helper.php';

if (isset($_POST['title']) && isset($_POST['urlRss'])) {
    $query = "SELECT * FROM users WHERE login = 'rss'";
    $result = $db->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $author_id = $row['id'];
    
    $query = "SELECT * FROM channels WHERE title = '".encode($_POST['title'])."'";
    $result = $db->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $channel_id = $row['id'];

    $rows = array();
    $query = "SELECT * FROM channel_messages WHERE channel_id = '".$channel_id."'";
    $result = $db->query($query);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $rows['url'] = $row;
    }

    $url = 'http://rian.ru/export/rss2/index.xml';
    $url = 'http://company.yandex.ru/press_releases/news.rss';

    function addRss($url_rss, $count, $db, $channel_id, $author_id)
    {
        $text_rss = file_get_contents($url_rss);

        $mas_item = array();
        preg_match_all("#<item>.*?</item>#is", $text_rss, $mas_item);

        $t = "";
        $kol = 0;
        if (sizeof($mas_item) > 0) {

            foreach ($mas_item[0] as $one_item) {
                $kol++;
                $t_is = preg_match("#<title>(.*?)</title>#is", $one_item, $title);
                $l_is = preg_match("#<link>(.*?)</link>#is", $one_item, $link);
                $d_is = preg_match("#<description>(.*?)</description>#is", $one_item, $description);
                if ($t_is and $l_is) {
                    $link[1] = preg_replace("#<\!\[CDATA\[(.*?)\]\]>#eis", "'\\1'", $link[1]);
                    if (isset($rows[$link[1]])) {
                        continue;
                    }
                    $title[1] = preg_replace("#<\!\[CDATA\[(.*?)\]\]>#eis", "'\\1'", $title[1]);
                    $description[1] = preg_replace("#<\!\[CDATA\[#eis", "'\\1'", $description[1]);
                    $description[1] = preg_replace("#\]\]\>#eis", "'\\1'", $description[1]);
                    $desc = htmlspecialchars("<a href='".$link[1]."' target='_blank'>".$title[1]."</a> <br>".$description[1]."", ENT_QUOTES);

                    $query = "INSERT INTO channel_messages(author_id, message, channel_id, url) values('$author_id','$desc', '$channel_id', '$link[1]')";                    
                    $result = $db->query($query);
                }
                if ($kol >= $count)
                    break;
            }
        }
        
    }
    
    addRss(encode($_POST['urlRss']), 5, $db, $channel_id, $author_id);
    echo 1;
    die;
}
echo 0;
?>