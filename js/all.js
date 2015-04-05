$(function () {
    var userLogin = "";

    // Регистрация пользователя
    $('#registrationButton').click(function (event) {
        registration();
    });

    // Авторизация пользователя
    $('#loginButton').click(function (event) {
        login();
    });

    function registration() {
        var login = $('#registration-block input[name="login"]').val();
        var password = $('#registration-block input[name="password"]').val();

        if (login.length == 0) {
            alert("Логин не может быть пустым");
        } else {
            $.ajax({
                type: "POST",
                url: 'registration.php',
                data: ({login: login, password: password}),
                success: function (msg) {
                    if (msg == 1) {
                        document.location.href = '/chat.php';
                    } else if (msg == 2) {
                        alert("Логин занят")
                    } else if (msg == 9) {
                        alert("Неверно введен логин или пароль")
                    }
                }
            });

        }
    }

    function login() {
        var login = $('#login-block input[name="login"]').val();
        var password = $('#login-block input[name="password"]').val();

        if (login.length == 0) {
            alert("Логин не может быть пустым");
        } else {
            $.ajax({
                type: "POST",
                url: 'login.php',
                data: ({login: login, password: password}),
                success: function (msg) {
                    if (msg == 1) {
                        document.location.href = '/chat.php';
                    } else if (msg == 2) {
                        alert("Неверно введен логин или пароль");
                    } else if (msg == 9) {
                        alert("Неверно введен логин или пароль");
                    }
                }
            });

        }
    }


}); 