<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

    <main class="container-fluid">
        <div class="center-block text-center">
            <h2 class="lead color_white">500. That's an error!</h2>
            <p class="color_white"><?php echo DB_ERROR; ?><br>Go to <a href="<?php echo APP_URL;?>/home/login">home page</a>.</p>
        </div>
        <div class="main_main_bottom"></div>
    </main>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>