<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

    <div class="login-container">
        <div id="output">
            <?php if(isset($form_error)) {
                foreach ($form_error as $errors) { echo $errors; }
            }?>
        </div>
        <div class="form-box">
            <form action="<?php echo APP_URL; ?>login" method="post">
                <input class="form-control" name="form[user]" type="text" placeholder="E-mail" style="border-radius: 5px 5px 0 0">
                <input class="form-control" name="form[password]" type="password" placeholder="Password" style="border-radius: 0 0 5px 5px;">
                <button class="login_home btn btn-info btn-block login" name="form[action]">Log In</button>
                <a href="register" class="login_home btn btn-danger btn-block login" >Sign Up</a>
            </form>
        </div>
    </div>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>