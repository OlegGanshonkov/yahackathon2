$(function () {
    var userLogin = "";

    // Выход
    $('#logout').click(function (event) {
        var login = $('#user-login').html();
        $.ajax({
            type: "POST",
            url: 'logout.php',
            data: ({login: login}),
            success: function (msg) {
                if (msg == 1) {
                    document.location.href = '/index.php';
                }
            }
        });
    });

    /*
     * CHAT
     */
    //Обновление списка channels
    //setInterval(channels, 1000);
    var CHANNELS = '';
    var MESSAGES = '';
    var CURRENT_TITLE = '';
    var TIMER_DATA = null;

    if (parts = String(document.location).split("?", 2)[1]) {
        var parts = String(document.location).split("?", 2)[1].split("&");
        var vars = parts[0].split('=');
        var name = vars[0];
        if (name == 'title') {
            var title = vars[1];
            if (title) {
                CURRENT_TITLE = title;
                openChannel(title);
            }
        }
    }

    function openChannel(title) {
        $.ajax({
            type: "POST",
            url: '/chat/openChannel.php',
            data: ({title: title}),
            success: function (msg) {
                if (msg) {
                    CURRENT_TITLE = title;
                    $('#title-room').html(title);
                    var stateParameters = {url: ''};
                    history.pushState(stateParameters, "", '/chat.php?title=' + title); // меняем адрес
                } else {
                    alert("Ошибка открытия Channel");
                }
            }
        });
    }

    function getData() {
        if (TIMER_DATA) {
            clearInterval(TIMER_DATA);
        }
        var title = CURRENT_TITLE;
        if (!title)
            title = $('#title-room').html();

        $.ajax({
            type: "POST",
            url: '/chat/getData.php',
            data: ({title: title}),
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, val) {
                    if (i == 'channels') {
                        CHANNELS = val;
                        $('#channel-list').html(CHANNELS);
                        initChannels();
                    } else if (i == 'messages') {
                        MESSAGES = val;
                        $('#msgs_div').html(MESSAGES);
                    }
                    else if (i == 'rss') {
                        RSS = val;
                        $('#rss-list').html(RSS);
                    }
                });
                TIMER_DATA = setInterval(getData, 1000);
            }
        });
    }
    TIMER_DATA = setInterval(getData, 1000);

    // Add channel
    $('#add-channel').click(function (event) {
        addChannel();
    });

    $('#channels_header').click(function (event) {
        $('#channel-block').show();
    });
    $('#channel-block .myClose').click(function (event) {
        $('#channel-block').hide();
    });



    function addChannel() {
        var title = $('#channel-block input[name="title"]').val();

        if (title.length == 0) {
            alert("Название не может быть пустым");
        } else {
            $.ajax({
                type: "POST",
                url: '/chat/addChannel.php',
                data: ({title: title}),
                success: function (msg) {
                    if (msg == 1) {
                        alert('Channel успешно добавлен');
                        $('#channel-block').hide();
                    } else if (msg == 2) {
                        alert("Channel с таким названием уже существует");
                    } else if (msg == 9) {
                        alert("Неверно введено название");
                    }
                }
            });

        }
    }

    function initChannels() {
        $('#channel-list i').each(function () {
            $(this).click(function (event) {
                openChannel($(this).html());
            });
        });
    }

    // Add message
    $('#message-input').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            addMessage();
            return false;
        }
    });

    function addMessage() {
        var login = $('#user-login').html();
        var message = $('#message-input').val();
        var title = $('#title-room').html();

        if (message.length == 0) {
            alert("Сообщение не может быть пустым");
        } else {
            $.ajax({
                type: "POST",
                url: '/chat/addMessage.php',
                data: ({message: message, login: login, title: title}),
                success: function (msg) {
                    if (msg == 1) {
                        /*alert('Сообщение успешно отправленно');*/
                        $('#message-input').val('');
                    } else if (msg == 9) {
                        alert("Сообщение введено неверно");
                    }
                }
            });

        }
    }

    // Add RSS
    $('#add-rss').click(function (event) {
        addRss();
    });

    function addRss() {
        var urlRss = $('#services input[name="rss"]').val();
        var title = $('#title-room').html();

        if (urlRss.length == 0) {
            alert("RSS не может быть пустым");
        } else {
            $.ajax({
                type: "POST",
                url: '/chat/svAddRSS.php',
                data: ({urlRss: urlRss, title: title}),
                success: function (msg) {
                    if (msg == 1) {
                        alert('RSS успешно добавлен');
                        $('#services input[name="rss"]').val('');
                        $('#services').hide();
                    } else if (msg == 2) {
                        alert("Такой RSS уже есть");
                    } else if (msg == 0) {
                        alert("Не правильно указан RSS");
                    }
                }
            });

        }
    }


    $('#stars_toggle').click(function (event) {
        $('#services').show();
    });
    $('#services .myClose').click(function (event) {
        $('#services').hide();
    });


}); 