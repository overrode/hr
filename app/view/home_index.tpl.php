<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<main class="container-fluid">
    <div class="row main_main_top"></div>
    <button type="button" class="center-block btn btn-danger" id="main_button">START TRACKING</button>
    <div id="gui"></div>
    <div id="canvas-container">
        <div id="mountains2"></div>
        <div id="mountains1"></div>
        <div id="skyline"></div>
    </div>

    <div class="main_main_bottom"></div>
</main>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>