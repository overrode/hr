<?php
@include APP_PATH . 'view/snippets/header.tpl.php';

if ($form_errors['isPasswordNotMatching']) : ?>
    <p style="text-align: center; color: #f70b03;"><em>Passwords don't match. Try again.</em></p>
<?php endif;

if (isset($form_errors['emailMessage'])) : ?>
    <p style="text-align: center; color: #f70b03; "><em><?php echo $form_errors['emailMessage'] ; ?></em></p>
<?php endif;
?>

<div class="container">
    <h2 align="center">Inregistrare</h2>
    <div class="center">
        <form method="post" action="<?php echo APP_URL; ?>register"
              class="form-horizontal" role="form" novalidate="novalidate">
            <div class="form-group" align="center">
                <label class="control-label col-sm-2"
                       for="form[nume]">Lastname<em>*</em></label>
                <div class="col-sm-6">
                    <input type="text" name="form[lastname]" id="form[user]"
                           placeholder="lastname" required="true" value="<?php echo $_POST['form']['lastname'];?>"
                           class="form-control <?php echo ($form_errors['errorLastName']) ? "errorClass" : "" ?>""/>
                </div>
<div class="login-container">
    <div id="output">
        <?php if ($msg) : ?>
            <p><em>Passwords don't match. Try again.</em></p>
        <?php endif; ?>
    </div>
    <div class="form-box">
        <form action="<?php echo APP_URL; ?>register" method="post">
            <div style="margin-bottom: 25px" class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                </span>
                <input type="text" class="form-control" name="form[nume]" value="" placeholder="First name">
            </div>
            <div style="margin-bottom: 25px" class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                </span>
                <input type="text" class="form-control" name="form[prenume]" value="" placeholder="Last name">
            </div>
            <div style="margin-bottom: 25px" class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-at" aria-hidden="true"></i>
                </span>
                <input type="email" class="form-control" name="form[email]" placeholder="E-mail">
            </div>
            <div style="margin-bottom: 25px" class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-user-secret" aria-hidden="true"></i>
                </span>
                <input type="password" class="form-control" name="form[password]" placeholder="Password">
            </div>
            <div style="margin-bottom: 25px" class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-user-secret" aria-hidden="true"></i>
                </span>
                <input type="password" class="form-control" name="form[confirmPass]" placeholder="Confirm Password">
            </div>
            <div style="margin-bottom: 25px" class="input-group">
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
