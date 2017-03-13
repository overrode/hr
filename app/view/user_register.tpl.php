<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <link href="../css/fontawesome.css" rel="stylesheet">
    <link href="../fonts/FontAwesome.otf" rel="stylesheet">
    <script src="../js/jquery-3.1.1.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <div class="container">

        <h2 align="center">Inregistrare</h2>

        <div class="center">
            <form method="post" action="<?php echo APP_URL; ?>register"
                  class="form-horizontal" role="form" align="center">
                <div class="form-group" align="center">
                    <label class="control-label col-sm-2"
                           for="form[nume]">Nume<em>*</em></label>
                    <div class="col-sm-6">
                        <input type="text" name="form[nume]" id="form[user]"
                               placeholder="nume" required="true"
                               class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2"
                           for="form[prenume]">Prenume<em>*</em></label>
                    <div class="col-sm-6">
                        <input type="text" name="form[prenume]"
                               id="form[prenume]" placeholder="prenume"
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
                           for="form[confirmPass]">Confirma parola<em>*</em></label>
                    <div class="col-sm-6">
                        <input type="password" name="form[confirmPass]"
                               id="form[confirmPass]" placeholder=""
                               required="true" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2"
                           for="form[job]">Job<em>*</em></label>
                    <div class="col-sm-6">
                        <input type="text" name="form[job]"
                               id="form[job]" placeholder="job"
                               required="true" class="form-control"/>
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

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>