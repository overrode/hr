<?php
@include APP_PATH . 'view/snippets/header.tpl.php';

if ($form_errors['isPasswordNotMatching']) : ?>
    <p style="text-align: center; color: #f70b03;"><em>Passwords don't match. Try again.</em></p>
<?php endif;

if (isset($form_errors['emailMessage'])) : ?>
    <p style="text-align: center; color: #f70b03; "><em><?php echo $form_errors['emailMessage'] ; ?></em></p>
<?php endif;
?>

<div class="login-container">
    <div id="output">
        <?php if ($msg) : ?>
            <p><em>Passwords don't match. Try again.</em></p>
        <?php endif; ?>
        <?php if (isset($emailMsg)) : ?>
            <p><em><?php echo $emailMsg ; ?></em></p>
        <?php endif; ?>
    </div>
    <div class="form-box">
        <form action="<?php echo APP_URL; ?>register" method="post">
            <!--First Name-->
            <div class="input-group margin_bottom">
                <span class="input-group-addon">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                </span>
                <input type="text" class="form-control <?php echo ($errFirstName) ? "errorClass" : "" ?>" name="form[firstname]" value="<?php echo $_POST['form']['firstname'];?>" placeholder="First name">
            </div>
            <!--Last Name-->
            <div class="input-group margin_bottom">
                <span class="input-group-addon">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                </span>
                <input type="text" class="form-control <?php echo ($errLastName) ? "errorClass" : "" ?>" name="form[lastname]" value="<?php echo $_POST['form']['lastname'];?>" placeholder="Last name">
            </div>
            <!--E-mail-->
            <div class="input-group margin_bottom">
                <span class="input-group-addon">
                    <i class="fa fa-at" aria-hidden="true"></i>
                </span>
                <input type="email" class="form-control <?php echo ($errorEmail) ? "errorClass" : "" ?>" name="form[email]" placeholder="E-mail" value="<?php echo $_POST['form']['email'];?>">
            </div>
            <!--Password-->
            <div class="input-group margin_bottom">
                <span class="input-group-addon">
                    <i class="fa fa-user-secret" aria-hidden="true"></i>
                </span>
                <input type="password" class="form-control <?php echo ($errPassword) ? "errorClass" : "" ?>" name="form[password]" placeholder="Password" value="<?php echo $_POST['form']['password'];?>">
            </div>
            <!--Re password-->
            <div class="input-group margin_bottom">
                <span class="input-group-addon">
                    <i class="fa fa-user-secret" aria-hidden="true"></i>
                </span>
                <input type="password" class="form-control <?php echo ($errConfirmPass) ? "errorClass" : "" ?>" name="form[confirmPass]" placeholder="Confirm Password" value="<?php echo $_POST['form']['confirmPass'];?>">
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

            <input name="btn-register" type="submit" id="trimite" value="Sign Up" class="btn btn-danger">
        </form>
    </div>
</div>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>
