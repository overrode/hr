<?php

/**
 * Controller for homepage and general pages.
 */
class controller_home {

    /**
     * This is the homepage.
     */
    function actionIndex($params) {
        @include_once APP_PATH . 'view/home_index.tpl.php';
    }

    /**
     * Login page for user.
     */
    public function action_login() {
        if (isset($_POST['form']['action'])) {
            $login_email = $_POST['form']['user'];
            $login_password = $_POST['form']['password'];
            $form_error = "";

            if(empty($login_email)){
                $form_error = "Please insert e-mail!";
                header('Location: login');
            } elseif (empty($login_password)) {
                $form_error = "Please insert password!";
                header('Location: login');
            }

            $user_login = model_user::getByEmail($login_email);
            $password_validate = $user_login->checkPassword($login_password);

            if (!empty($user_login) && $password_validate) {
                $_SESSION['logged'] = TRUE;
                $_SESSION['user'] = $user_login->lastname;
                header('Location: track');
            }
        }
        //die();
        @include_once APP_PATH . 'view/home_index.tpl.php';
    }

    /**
     * Register page for user.
     */
    function actionRegister() {
        if (isset($_POST['btn-register'])) {
            $nume = $_POST['form']['nume'];
            $prenume = $_POST['form']['prenume'];
            $email = $_POST['form']['email'];
            $password = $_POST['form']['password'];
            $confirmPassword = $_POST['form']['confirmPass'];
            $job = $_POST['form']['job'];

            if ($user = model_user::addUser($nume, $prenume, $email, $password, $job)) {
                header('Location: login');
                die();
            }
            else {
                header('Location: register');
            }
        }
        @include_once APP_PATH . 'view/user_register.tpl.php';
    }

    function actionTrack() {
        @include_once APP_PATH . 'view/track_page.tpl.php';
    }
}