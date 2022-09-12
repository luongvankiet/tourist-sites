<?php $authenticatedUser = \App\Core\Application::$app->authenticatedUser ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tourist Site</title>

    <link rel="stylesheet" href="resources/assets/css/index.css">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="container">
            <h2 class="navbar-brand">Tourist Site</h2>
            <ul class="d-flex gap-1">
                <li class="text-hover-secondary"><a href="#">Home</a></li>
                <li class="text-hover-secondary"><a href="#">About</a></li>
                <li class="text-hover-secondary"><a href="#">Contact</a></li>

                <?php if (isset($authenticatedUser)) { ?>
                    <li class="text-hover-secondary">
                        <div class="dropdown dropdown-right">
                            <span>Hello <?php echo $authenticatedUser->email ?></span>
                            <div class="dropdown-content">
                                <a href="<?php echo \App\Core\Application::$APP_URL?>/profile">profile</a>
                                <hr>
                                <a href="<?php echo \App\Core\Application::$APP_URL?>/auth/logout">Logout</a>
                            </div>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class="text-hover-secondary"><a href="<?php echo \App\Core\Application::$APP_URL?>/auth/login">Login</a></li>
                    <li class="text-hover-secondary"><a href="<?php echo \App\Core\Application::$APP_URL?>/auth/register">Register</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <!-- content -->
    @yield('content')

    <script src="<?php echo \App\Core\Application::$ASSET_PATH?>/js/jquery-3.6.1.min.js"></script>
    <script src="<?php echo \App\Core\Application::$ASSET_PATH?>/js/carousel.js"></script>
</body>

</html>
