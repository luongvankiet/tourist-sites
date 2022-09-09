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
                <li class="text-hover-secondary"><a href="/auth/login">Login</a></li>
            </ul>
        </div>
    </nav>

    <!-- alert -->
    <?php if (\App\Core\Application::$app->session->getFlash('success')) { ?>
        <div class="alert alert-success">
            <?php echo \App\Core\Application::$app->session->getFlash('success') ?>
        </div>
    <?php }?>
    
    <!-- content -->
    @yield('content')

    <script src="./resources/assets/js/jquery-3.6.1.min.js"></script>
</body>

</html>
