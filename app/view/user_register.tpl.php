<?php
@include APP_PATH . 'view/snippets/header.tpl.php';
?>

<?php if ($msg) : ?>
    <p><em>Passwords don't match. Try again.</em></p>
<?php endif; ?>

    <div class="container">
        <h2 align="center">Inregistrare</h2>
        <div class="center">
            <form method="post" action="<?php echo APP_URL; ?>register"
                  class="form-horizontal" role="form">
                <div class="form-group" align="center">
                    <label class="control-label col-sm-2"
                           for="form[nume]">Nume<em>*</em></label>
                    <div class="col-sm-6">
                        <input type="text" name="form[nume]" id="form[user]"
                               placeholder="lastname" required="true"
                               class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2"
                           for="form[prenume]">Prenume<em>*</em></label>
                    <div class="col-sm-6">
                        <input type="text" name="form[prenume]"
                               id="form[prenume]" placeholder="firstname"
                               required="true" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2"
                           for="form[email]">Email<em>*</em></label>
                    <div class="col-sm-6">
                        <input type="text" name="form[email]"
                               id="form[email]" placeholder="email"
                               required="true" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2"
                           for="form[password]">Parola<em>*</em></label>
                    <div class="col-sm-6">
                        <input type="password" name="form[password]"
                               id="form[password]" placeholder="password"
                               required="true" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2"
                           for="form[confirmPass]">Confirma
                        parola<em>*</em></label>
                    <div class="col-sm-6">
                        <input type="password" name="form[confirmPass]"
                               id="form[confirmPass]" placeholder="confirm password"
                               required="true" class="form-control"/>
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
