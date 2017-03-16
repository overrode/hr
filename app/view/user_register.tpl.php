<?php
@include APP_PATH . 'view/snippets/header.tpl.php';
?>

<?php if ($form_errors['isPasswordNotMatching']) : ?>
    <p style="text-align: center; color: #f70b03;"><em>Passwords don't match. Try again.</em></p>
<?php endif; ?>

<?php if (isset($form_errors['emailMessage'])) : ?>
    <p style="text-align: center; color: #f70b03; "><em><?php echo $form_errors['emailMessage'] ; ?></em></p>
<?php endif; ?>

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
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2"
                       for="form[firstname]">Firstname<em>*</em></label>
                <div class="col-sm-6">
                    <input type="text" name="form[firstname]"
                           id="form[firstname]" placeholder="firstname" value="<?php echo $_POST['form']['firstname'];?>"
                           required="true" class="form-control  <?php echo ($form_errors['errorFirstName']) ? "errorClass" : "" ?>""/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2"
                       for="form[email]">Email<em>*</em></label>
                <div class="col-sm-6">
                    <input type="text" name="form[email]"
                           id="form[email]" placeholder="email" value="<?php echo $_POST['form']['email'];?>"
                           required="true" class="form-control <?php echo ($form_errors['errorEmail']) ? "errorClass" : "" ?>""/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2"
                       for="form[password]">Parola<em>*</em></label>
                <div class="col-sm-6">
                    <input type="password" name="form[password]"
                           id="form[password]" placeholder="password" value="<?php echo $_POST['form']['password'];?>"
                           required="true" class="form-control <?php echo ($form_errors['errorPassword']) ? "errorClass" : "" ?>""/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2"
                       for="form[confirmPass]">Confirma
                    parola<em>*</em></label>
                <div class="col-sm-6">
                    <input type="password" name="form[confirmPass]"
                           id="form[confirmPass]" placeholder="confirm password" value="<?php echo $_POST['form']['confirmPass'];?>"
                           required="true" class="form-control <?php echo ( $form_errors['errorConfirmPass']) ? "errorClass" : "" ?>""/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2"
                       for="form[job]">Job<em>*</em></label>
                <div class="col-sm-6">
                    <select name="form[job]"
                            id="form[job]"
                            required="true" class="form-control">
                        <?php
                        foreach ($jobs as $val) {
                            ?>
                            <option value="<?php echo $val['job']; ?>"> <?php echo $val['job']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <input type="submit" name="btn-register" id="trimite"
                           value="Trimite" class="btn btn-primary"/>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
@include APP_PATH . 'view/snippets/footer.tpl.php';
?>
