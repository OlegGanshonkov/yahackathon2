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
        <meta name="author" content="OpenCommunity">
        <title>OpenCommunity</title>       
        <!-- output_css "client_core" -->
        <link href="css/rollup-client-core.css" rel="stylesheet" type="text/css">

        <!-- output_css "client_general" -->
        <link href="css/rollup-client-general.css" rel="stylesheet" type="text/css">

        <!-- output_css "client_secondary" -->
        <link href="css/rollup-client_secondary.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="/css/style.css"/>

        <script src="/js/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="/js/chat.js" type="text/javascript"></script>    
        <style type="text/css" media="screen">
            .chat-ava {
                position: absolute;
            }
            .chat-text {
                padding-left: 50px;
            }
            .chat-user-name {
                color: #00404B;
                font-size: 16px;
            }
        </style>
    </head>
    <body>
        <div id="user-login"><?php echo $_SESSION['user']; ?></div>

        <div style="height:2px; background-image: url('images/topline.png')"></div>

        <div id='client-ui' class='container-fluid sidebar_theme_ocean_theme'>

            <div id="header" class="feature_flexpane_rework">
        
                <div id="channel_header">

                    <div id="team_menu">
                        <span id="team_name" class="overflow_ellipsis right_padding" style="font-size: 1.4rem;">OpenCommunity</span>
                        <i class="fa fa-chevron-down"></i>
                    </div>          
                    
                    <h2 id="active_channel_name" class="overflow_ellipsis">
                        <span class="name "><span class="prefix">&#35;</span> <span id="title-room">Выберите комнату</span>  <span id="logout" style="margin-top:10px;" class="close myClose">X</span></span>
                    </h2>
                
                </div>

                <a id="details_toggle" title="Show Channel Info" class="flexpane_toggle_button">
                    <img src="images/users.png" />
                </a>

                <a id="details_toggle" title="Show Channel Info" class="flexpane_toggle_button" style="right: 400px; top: 20px; opacity: 50%;">
                    523
                </a>

                <a id="details_toggle" title="Show Channel Info" class="flexpane_toggle_button" style="right: 370px; top: 20px; color: #06A56F; opacity: 50%;">
                    [15]
                </a>

                <div id="search_container">
                    <form method="get" action="/search" id="header_search_form" class="search_form no_bottom_margin">
                        <input type="text" id="search_terms" name="q" class="search_input" placeholder="Поиск" autocomplete="off" value="" maxlength="250" style="-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;" />
                    </form>
                </div>

                <a id="recent_mentions_toggle" title="Show Recent Mentions" class="flexpane_toggle_button">
                    <img src="images/sobaka.png" height="19" width="20" />
                </a>

                <a id="stars_toggle" title="Show Bookmarks" class="flexpane_toggle_button">
                    <img src="images/share.png" height="20" width="19" />
                </a>
            
            </div>

            <div id="footer">

                <div id="footer_msgs">

                    <!-- 				<div id='messages-input-container'>
                                                            <input type="text" autocomplete="off" value="" />
                                                    </div>	 -->			

                    <div id="messages-input-container" style="height: 41px;">
                        <form id="message-form" style="height: 41px;">
                            <textarea id="message-input" class="with-emoji-menu"  aria-label="Message input for Group sl2-project"  spellcheck="true" style="overflow-y: hidden; height: 38px;"></textarea>
                        </form>
                    </div>

                </div>
            </div>

            <div id="client_body">

                <div id="col_messages">

                    <div class="row-fluid">

                        <div id="col_channels" class="show_presence channels_list_holder no_just_unreads">

                            <div id="channels_scroller">

                                <div id="starred_div" class="starred_section section_holder">
                                    <h2 id="starred_section_header" class="overflow_ellipsis"><i class="fa fa-star" style="font-size: 14px;"></i>Избранное</h2>
                                    <ul id="starred-list"></ul>
                                </div>

                                <div id="channels" class="section_holder">
                                    <h2 id="channels_header" class="hoverable overflow_ellipsis">Комнаты +</h2>
                                    <ul id="channel-list"></ul>
                                    <div class="clear_both"></div>
                                </div>


                                <div id="direct_messages" class="section_holder">
                                    <h2 id="direct_messages_header" class="hoverable overflow_ellipsis">Контакты</h2>
                                    <ul id="im-list"></ul>
                                    <div class="clear_both"></div>
                                </div>

                            </div>

                            <div id='user_menu'>
                                <div id="current_user_avatar"><span class="member_image thumb_48" style="background-image: url('images/ava.jpg')"></span></div>
                                <span id="current_user_name" class="overflow_ellipsis"><?php echo $_SESSION['user']; ?></span>
                                <span id="connection_status"></span>
                                <i class="fa fa-chevron-up"></i>
                            </div>

                        </div>

                        <div id="messages_container">

                            <div id="msgs_scroller_div" tabindex="1">

                                <div id="msgs_div" class="msgs_holder">

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="channel-block">
            <h2>Добавить комнату <span class="close myClose">X</span></h2>
            <div class="col1">
                Название: 
            </div>
            <div class="col2">
                <input name="title" type="text"/>
            </div>
            <div class="clear"></div> 
            <button id="add-channel">Добавить</button>
            <div class="clear"></div>
        </div>

        <div id="services">
            <h2>Добавить сервис <span class="close myClose">X</span></h2>
            <div class="col1">
                Rss: 
            </div>
            <div class="col2">
                <input name="rss" type="text"/>
            </div>
            <div class="clear"></div> 
            <button id="add-rss">Добавить</button>
            <div class="clear"></div>
            <hr/>
            Добавленные RSS:
            <div id="rss-list"></div>
        </div>

    </body>
</html>
