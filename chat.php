<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo 'Доступ запрещён';
    die;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>    
        <meta name="language" content="ru"/>
        <title>OpenCommunity</title>        
        <link rel="stylesheet" type="text/css" href="/css/style.css"/>
        <script src="/js/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="/js/chat.js" type="text/javascript"></script>       
    </head>
    <body>
        <div id="user-login"><?php echo $_SESSION['user']; ?></div>
        <div id='main'>
            <h1 align='center'>OpenCommunity</h1>
            <div id="login-block"><?php echo $_SESSION['user']; ?>
                <button id="logout">Выйти</button>
            </div>            
            <div id="channel-block">
                <h2>Channels</h2>
                <div class="col1">
                    Название: 
                </div>
                <div class="col2">
                    <input name="title" type="text"/>
                </div>
                <div class="clear"></div> 
                <button id="add-channel">Добавить</button>
                <div class="clear"></div>
                <hr/>
                <div id="channels"></div>
            </div>
            <div id="room">
                <div class="top">
                    <h2>Channel</h2>
                </div>
                <div class="messages">

                </div>
                <div class="message-block">
                    <span>Введите сообщение:</span><br>
                    <textarea cols="70" rows="10" id="newMessage"></textarea>
                    <br>
                    <button id="newMessage-button">Отправить</button>
                    <div class="clear"></div>
                </div>

            </div>
        </div>
    </body>
</html>
