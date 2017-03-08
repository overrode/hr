<html>
<head>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <link href="../css/fontawesome.css" rel="stylesheet">
    <link href="../fonts/FontAwesome.otf" rel="stylesheet">
    <script src="../js/jquery-3.1.1.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	<title>
		<?php if (isset($html_head_title)) : ?>
			<?php echo $html_head_title; ?> |
		<?php endif ?>
	</title>
</head>

<body>

<div class="container-fluid">
    <header class="row">
        <div class="col-md-4 col-xs-12 text-center well"><i class="fa fa-clock-o" style="font-size: 25px;"></i><h1>TIME IT</h1></div>
        <div class="col-md-4 col-xs-12 text-center pull-right well"><i class="fa fa-user-o" style="font-size: 25px;"></i><h1><?php echo "User"; ?></h1></div>
    </header>
</div>
