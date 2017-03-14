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
    public function action_login() {
        //Saving form values in variables
        $login_email = $_POST['form']['user'];
        $login_password = $_POST['form']['password'];
        //Chaching the form errors
        $form_error = array('email' => empty($login_email) ? "Please insert your email" : false,
            'password' => empty($login_password) ? "Please insert your password" : false
            );
        //Checks email and password for validation
        if(isset($_POST['form']['action'])) {
            $user_login = model_user::getByEmail($login_email);
            if (!empty($user_login) && $user_login->checkPassword($login_password)) {
                $_SESSION['logged'] = TRUE;
                $_SESSION['user'] = $user_login->lastname;
                header('Location: track');
            }
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
            }
            else {
                header('Location: register');
            }
        }
        @include_once APP_PATH . 'view/user_register.tpl.php';
    }

    function action_track() {
        @include_once APP_PATH . 'view/track_page.tpl.php';
    }
}
