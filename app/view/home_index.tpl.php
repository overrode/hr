<?php
@include APP_PATH . 'view/snippets/header.tpl.php';
?>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <link href="../css/fontawesome.css" rel="stylesheet">
    <link href="../fonts/FontAwesome.otf" rel="stylesheet">
    <script src="../js/jquery-3.1.1.js"></script>
    <script src="../js/custom.js"></script>
    <script src="../js/bootstrap.min.js"></script>

<?php if ($form_error) : ?>
    <p><em>Utilizator sau parola gresita. Reincercati.</em></p>
<?php endif;
 ?>

    <div class="form-group">
        <div class="col-sm-offset-8">
            <a href="/home/register"
               class="btn btn-primary btn-lg">Inregistrare</a>
        </div>
    </div>

    <div class="container">
        <h2 align="center"> Autentificare </h2>

        <div class="center">
            <form method="post" action="<?php echo APP_URL; ?>login"
                  class="form-horizontal" role="form" align="center">
                <div class="form-group" align="center">
                    <label class="control-label col-sm-2" for="form[user]">Utilizator<em>*</em></label>
                    <div class="col-sm-6">
                        <input type="text" name="form[user]" id="form[user]"
                               placeholder="user" required="true"
                               class="form-control"/>
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
                    <div class="col-sm-offset-2 col-sm-8">
                        <input type="submit" name="form[action]" id="trimite"
                               value="Trimite" class="btn btn-primary btn-lg"/>
                    </div>
                </div>

            </form>
        </div>
    </div>
<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>