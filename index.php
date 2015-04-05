<?php
//require_once 'mysqlConnect.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <script src="/js/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="/js/all.js" type="text/javascript"></script>
        <title>OpenCommunity - Login</title>
        <link rel="stylesheet" href="css/style2.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700">

        <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
     <![endif]-->

    </head>
    <body>
        <div class="container">

            <div style="margin-bottom: 20px; font-size: 1.4rem; text-align: center;">
                <img src="images/comm-icon.png" height="100" width="100" alt=""><br /><br />
                OpenCommunity
            </div>

            <div id="login">

                <form action="javascript:void(0);" method="get">

                    <fieldset class="clearfix">

                        <p><span class="fontawesome-user"></span><input type="text" name="login" value="Пользователь" onBlur="if (this.value == '')
                        this.value = 'Пользователь'" onFocus="if (this.value == 'Пользователь')
                                    this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Пользователь" -->
                                                        <p><span class="fontawesome-lock"></span><input type="password" name="password"  value="Password" onBlur="if (this.value == '')
                        this.value = 'Password'" onFocus="if (this.value == 'Password')
                                    this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
                        <p><input id="loginButton" type="submit" value="Войти"></p>

                    </fieldset>

                </form>

            </div> <!-- end login -->

            <br />

            <div id="registration-block">

                <form action="javascript:void(0);" method="get">

                    <fieldset class="clearfix">

                        <p><span class="fontawesome-user"></span><input type="text" name="login" value="Пользователь" onBlur="if (this.value == '')
                        this.value = 'Пользователь'" onFocus="if (this.value == 'Пользователь')
                                    this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Пользователь" -->
                                                        <p><span class="fontawesome-lock"></span><input type="password" name="password"  value="Password" onBlur="if (this.value == '')
                        this.value = 'Password'" onFocus="if (this.value == 'Password')
                                    this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
                                                        <p><input id="registrationButton"  type="submit" value="Зарегистрироваться"></p>

                    </fieldset>

                </form>

            </div> <!-- end login -->

        </div>

        </div>
    </body>
</html>
