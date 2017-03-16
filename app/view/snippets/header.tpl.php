<html>
<head>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <link href="../css/fontawesome.css" rel="stylesheet">
    <link href="../fonts/FontAwesome.otf" rel="stylesheet">
    <title>
        <?php if (isset($html_head_title)) : ?>
            <?php echo $html_head_title; ?> |
        <?php endif ?>
    </title>
</head>
<body>

<header class="container-fluid">
    <div class="row">
        <a href="/home/login">
        <div class="col-md-2 col-xs-5 text-center " id="header_time-it">
            <i class="fa fa-clock-o" style="font-size: 20px;"></i>
            <h1>TIME IT</h1>
        </div>
        </a>
        <div class="col-md-2 col-xs-5 text-center pull-right " id="header_user">
            <i class="fa fa-user-o" style="font-size: 20px;"></i>
            <?php if($_SESSION['logged']) {?>
            <a href="/home/logout" id="logout" title="LOGOUT"><i class="fa fa-power-off" style="color:#f70b03" aria-hidden="true"></i></a>
            <?php } ?>
            <?php if($_SESSION['logged']) { ?>
            <h1 class="text-uppercase"><?php echo $_SESSION['user']; ?></h1>
            <?php } else { ?>
            <h1 class="text-uppercase"><?php echo "Welcome"; ?></h1>
            <?php } ?>
        </div>
    </div>
</header>
