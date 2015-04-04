<?php
//require_once 'mysqlConnect.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>    
        <meta name="language" content="ru"/>
        <title>OpenCommunity</title>        
        <link rel="stylesheet" type="text/css" href="/css/style.css"/>
        <script src="/js/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="/js/all.js" type="text/javascript"></script>       
    </head>
    <body>
        <div id='main'>
            <h1 align='center'>OpenCommunity</h1>
            <div id="login-block">
                <div class="col1">
                    Логин: 
                </div>
                <div class="col2">
                    <input name="login" type="text"/> 
                </div>
                <div class="clear"></div>
                <div class="col1">
                    Пароль: 
                </div>
                <div class="col2">
                    <input name="password" type="password" type="text" />
                </div>   
                <div class="clear"></div>
                <div class="space"></div>
                <button id="loginButton">Войти</button>

            </div>

            <div id="registration-block">
                <div class="col1">
                    Логин: 
                </div>
                <div class="col2">
                    <input name="login" type="text"/> 
                </div>
                <div class="clear"></div>
                <div class="col1">
                    Пароль: 
                </div>
                <div class="col2">
                    <input name="password" type="password" type="text" />
                </div>   
                <div class="clear"></div>
                <div class="space"></div>
                <button id="registrationButton">Зарегистрироваться</button>
            </div>

        </div>
    </body>
</html>
