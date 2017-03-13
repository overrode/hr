<?php

/**
 * Controller for homepage and general pages.
 */
class controller_home {

    /**
     * This is the homepage.
     */
    function action_index($params) {

        @include_once APP_PATH . 'view/home_index.tpl.php';
    }

    /**
     * Login page for user.
     */
    function action_login() {

        $_SESSION['form_error'] = FALSE;
        if (isset($_POST['form']['action'])) {
            if ($user_id = model_user::validate($_POST['form']['user'], $_POST['form']['password'])) {
                header('Location: track');
                die();
            }
            $_SESSION['form_error'] = TRUE;
        }
        @include_once APP_PATH . 'view/home_index.tpl.php';
    }

    /**
     * Register page for user.
     */
    function action_register() {

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
            }else{
                header('Location: register');
            }
        }
        @include_once APP_PATH . 'view/user_register.tpl.php';
    }

    function action_track() {
        @include_once APP_PATH . 'view/track_page.tpl.php';
    }
}