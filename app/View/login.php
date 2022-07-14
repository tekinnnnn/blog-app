<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <?php inc('styles'); ?>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .checkbox {
            font-weight: 400;
        }
        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>
<body>
<form id="login" class="form-signin">
    <img class="mb-4" src="https://via.placeholder.com/72.png/09f/fff" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <input type="hidden" name="csrf_token" value="<?= \Tekinaydogdu\Check24\Core\Security\CSRF::refresh() ?>">
    <label for="email">
        <input id="email" type="email" name="email" class="form-control" placeholder="Email" required autofocus>
    </label>
    <label for="password">
        <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
    </label>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>

    <p id="error"></p>
</form>
</body>
<?php inc('scripts'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    document.getElementById('email').focus();

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            $('#login').submit();
        }
    });

    $('#login').submit(function (e) {
        e.preventDefault();
        $.post('/login', $(this).serialize(), function (data) {
            if (data.status) {
                window.location.href = '/home';
            } else {
                $('#login').find('p').text(data.message);
            }
        });
    });

    function login() {
        $.ajax({
            url: '/login',
            method: 'POST',
            data: {
                email: $('#email').val(),
                password: $('#password').val(),
                csrf_token: $('input[name="csrf_token"]').val()
            },
            success: function (data) {
                if (data.status) {
                    window.location.href = '/home';
                } else {
                    $('#error').text(data.message);
                }
            }
        });
    }
</script>
</html>