
<!doctype html>
<html lang="en">

<head>
    <title>Welcome</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/front/css/font-awesome.css">
    <link rel="stylesheet" href="/front/css/styles.css">
    <script src="/bower_components/jquery-3.4.1.min/index.js"></script>

    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/front/css/font-awesome.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="/bower_components/jquery/src/jquery.js"></script>
    <script src="/front/js/js.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-bg mb-5">
    <a style="margin-left: 75px;" class="navbar-brand space-brand" href="/">Тестовое
        задание</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown" style="margin-right: 75px;">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="nav-profile-img rounded-circle" src="/front/images/ProfileCat.jpg">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?php if (!empty($user)) { ?>
                        Привет, <?= $user->getNickname() ?>
                        <a class="dropdown-item" href="/logout">Выйти</a>
                    <?php } else { ?>
                        <a class="dropdown-item" href="/login">Войти в профиль</a>
                    <?php } ?>
                </div>
            </li>
        </ul>
    </div>
</nav>
<?php /**@var \App\Services\SessionWrapper\SessionWrapper $sessionWrapper */ ?>
<div class="container">
    <div style="text-align: center;">
        <?php if (!empty($_SESSION['error'])): ?>
            <div style="background-color: red;padding: 5px;margin: 15px"><?= \App\Services\SessionWrapper\SessionWrapper::handle('error') ?></div>
        <?php endif; ?>
    </div>

</div>