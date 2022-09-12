<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tourist Site</title>

    <link rel="stylesheet" href="<?php echo \App\Core\Application::$ASSET_PATH?>/css/index.css">
    <link rel="stylesheet" href="<?php echo \App\Core\Application::$ASSET_PATH?>/css/style.css">
</head>

<body style="background-color: #efefef;">
    <!-- content -->
    @yield('content')

    <script src="<?php echo \App\Core\Application::$ASSET_PATH?>/js/form.js"></script>
    <script src="<?php echo \App\Core\Application::$ASSET_PATH?>/js/jquery-3.6.1.min.js"></script>
</body>

</html>
