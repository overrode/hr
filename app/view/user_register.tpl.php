<?php
@include APP_PATH . 'view/snippets/header.tpl.php';
?>

<div class="login-container">
    <div id="output">
        <?php if ( $form_errors['isPasswordNotMatching']) : ?>
            <em>Passwords don't match. Try again.</em>
        <?php endif; ?>
        <?php if (isset($form_errors['emailMessage'])): ?>
           <em><?php echo $form_errors['emailMessage'] ; ?></em>
        <?php endif;
        if (isset($form_errors['limitMessage'])): ?>
            <em><?php echo $form_errors['limitMessage'] ; ?></em>
        <?php endif;
        ?>
    </div>
    <div class="form-box">
        <form action="<?php echo APP_URL; ?>/home/register" method="post" novalidate="novalidate">
            <!--First Name-->
            <div class="input-group margin_bottom">
                <span class="input-group-addon">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                </span>
                <input type="text" class="form-control <?php echo ($form_errors['errorFirstName']) ? "errorClass" : "" ?>" name="form[firstname]" value="<?php echo $_POST['form']['firstname'];?>" placeholder="First name">
            </div>
            <!--Last Name-->
            <div class="input-group margin_bottom">
                <span class="input-group-addon">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                </span>
                <input type="text" class="form-control <?php echo ($form_errors['errorLastName']) ? "errorClass" : "" ?>" name="form[lastname]" value="<?php echo $_POST['form']['lastname'];?>" placeholder="Last name">
            </div>
            <!--E-mail-->
            <div class="input-group margin_bottom">
                <span class="input-group-addon">
                    <i class="fa fa-at" aria-hidden="true"></i>
                </span>
                <input type="email" class="form-control <?php echo ($form_errors['errorEmail']) ? "errorClass" : "" ?>" name="form[email]" placeholder="E-mail" value="<?php echo $_POST['form']['email'];?>">
            </div>
            <!--Password-->
            <div class="input-group margin_bottom">
                <span class="input-group-addon">
                    <i class="fa fa-user-secret" aria-hidden="true"></i>
                </span>
                <input type="password" class="form-control <?php echo ($form_errors['errorPassword']) ? "errorClass" : "" ?>" name="form[password]" placeholder="Password" value="<?php echo $_POST['form']['password'];?>">
            </div>
            <!--Re password-->
            <div class="input-group margin_bottom">
                <span class="input-group-addon">
                    <i class="fa fa-user-secret" aria-hidden="true"></i>
                </span>
                <input type="password" class="form-control <?php echo ($form_errors['errorConfirmPass']) ? "errorClass" : "" ?>" name="form[confirmPass]" placeholder="Confirm Password" value="<?php echo $_POST['form']['confirmPass'];?>">
            </div>
            <!--Job Name-->
            <div class="input-group margin_bottom">
                <span class="input-group-addon">
                    <i class="fa fa-address-card-o" aria-hidden="true"></i>
                </span>
                <select class="form-control" name="form[job]">
                    <?php
                    foreach ($jobs as $val) {
                        ?>
                        <option class="input-group-addon" value="<?php echo $val['job']; ?>"> <?php echo $val['job']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button class="login_home btn btn-danger btn-block login" name="btn-register">Sign Up</button>
            <a href="/" class="login_home btn btn-success login" >Back</a>
        </form>
    </div>
</div>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>
