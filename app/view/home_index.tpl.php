<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<div class="login-container">
    <div id="output"><?php echo $form_error['email']  ? "yes" : "no"; ;?>
    </div>
    <div class="form-box">
        <form action="<?php echo APP_URL; ?>login" method="post">
            <input name="form[user]" type="text" placeholder="E-mail">
            <input name="form[password]" type="password" placeholder="Password">
            <button class="btn btn-info btn-block login" name="form[action]" type="submit">Sign In</button>
            <button class="btn btn-danger btn-block login" name="" type="submit">Sign Up</button>
        </form>
    </div>
</div>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>