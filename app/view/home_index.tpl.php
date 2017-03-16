<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<div class="login-container">
    <div id="output">
        <?php //var_dump($user_password); ?>
        <?php if(isset($form_error)) {
            foreach ($form_error as $errors) { echo $errors; }
        }?>
    </div>
    <div class="form-box">
        <form action="<?php echo APP_URL; ?>login" method="post">
            <input name="form[user]" type="text" placeholder="E-mail"">
            <input name="form[password]" type="password" placeholder="Password">
            <button class="btn btn-info btn-block login" name="form[action]" type="submit">Sign In</button>
            <a href="register" class="btn btn-danger btn-block login" >Sign Up</a>
        </form>
    </div>


</div>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>