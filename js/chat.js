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

    function channels() {
        $.ajax({
            type: "POST",
            url: "/chat/channels.php",
            success: function (html) {
                $('#channels').html(html);
                initChannels();
            }
        });
    }
    channels();


    // Add channel
    $('#add-channel').click(function (event) {
        addChannel();
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
                    } else if (msg == 2) {
                        alert("Channel с таким названием уже существует");
                    } else if (msg == 9) {
                        alert("Неверно введено название");
                    }
                }
            });

        }
    }

    // Open channel
    function initChannels() {
        $('#channels a').each(function () {
            $(this).click(function (event) {
                openChannel($(this).html());
            });
        });
    }

    function openChannel(title) {
        $.ajax({
            type: "POST",
            url: '/chat/openChannel.php',
            data: ({title: title}),
            success: function (msg) {
                if (msg) {
                    $('#room h2').html(msg);
                    var stateParameters = {url: ''};
                    history.pushState(stateParameters, "", '/chat.php?title=' + title); // меняем адрес
                    channelMessages();
                } else {
                    alert("Ошибка открытия Channel");
                }
            }
        });
    }

    if (parts = String(document.location).split("?", 2)[1]) {
        var parts = String(document.location).split("?", 2)[1].split("&");
        var vars = parts[0].split('=');
        var name = vars[0];
        if (name == 'title') {
            var title = vars[1];
            if (title) {
                openChannel(title);
            }
        }
    }

    function channelMessages() {
        var title = $('#room .top h2').html();

        $.ajax({
            type: "POST",
            url: '/chat/channelMessages.php',
            data: ({title: title}),
            success: function (msg) {
                if (msg) {
                    $('#room .messages').html(msg);
                } else {
                    $('#room .messages').html('');
                }
            }
        });
    }

    // Add message
    $('#newMessage-button').click(function (event) {
        addMessage();
    });

    function addMessage() {
        var login = $('#user-login').html();
        var message = $('#newMessage').val();
        var title = $('#room .top h2').html();

        if (message.length == 0) {
            alert("Сообщение не может быть пустым");
        } else {
            $.ajax({
                type: "POST",
                url: '/chat/addMessage.php',
                data: ({message: message, login:login, title: title}),
                success: function (msg) {
                    if (msg == 1) {
                        alert('Сообщение успешно отправленно');
                    } else if (msg == 9) {
                        alert("Сообщение введено название");
                    }
                }
            });

        }
    }



}); 