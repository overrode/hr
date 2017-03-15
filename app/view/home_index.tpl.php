<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<div class="login-container">
    <div id="output"><?php echo $form_error;?>
    </div>
    <div class="form-box">
        <form action="<?php echo APP_URL; ?>login" method="post">
            <input name="form[user]" type="text" placeholder="E-mail">
            <input name="form[password]" type="password" placeholder="Password">
            <button class="btn btn-info btn-block login" name="form[action]" type="submit">Sign In</button>
        </form>
    </div>

    <form action="<?php echo APP_URL; ?>register" method="post">
        <div class="form-group">
                <button class="btn btn-danger btn-block login" name="" type="submit">Sign Up</button>
        </div>
    </form>
</div>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>