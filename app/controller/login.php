<?php

/**
 * Controller for user login.
 */
class controller_login {

    /**
     * Login page for user.
     */
    function actionLogin($email_login, $password_login) {

        $email_login = $_POST['email'];
        $password_login = $_POST['email'];
        $form_error = "";

        @include_once APP_PATH . 'view/user_login.tpl.php';

        if (isset($_POST['submit'])) {
            if( !empty($email_login) && !empty($password_login) ) {
                if( model_user::checkPassword($password_login)  && model_user::getByEmail($email_login) === $email_login] ) {
                    $_SESSION["logged"] = true;
                    header('Location: ' . APP_URL . 'admin');
                } else {
                    $form_error = "E-mail or password incorrect!";
                }
            }
        }
    }

    /**
     * Logout action.
     */
    function action_logout() {
        $_SESSION["logged"] = false;
        unset($_SESSION['logged']);
        header('Location: ' . APP_URL . 'user/login');
        die;
    }
}