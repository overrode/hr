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

        //Checks email and passwordfor validation
        if(isset($_POST['form']['action'])) {
            $user_login = model_user::getByEmail($login_email);
            $user_email = $user_login->email;

            //Chaching the form errors
            $form_error = array(
                'no_email' => empty($login_email) ? "Please insert your email" : "",
                'no_password' => empty($login_password) ? "Please insert your password" : "",
                'wrong_email' => ($user_email != $login_email) ? "Wrong e-mail" : "",
                'wrong_password' => $user_login->password ? "Wrong password" : "",

            );
            if ($user_email === $login_email && $user_login->checkPassword($login_password)) {
                $_SESSION['logged'] = TRUE;
                $_SESSION['user_id'] = $user_login->id;
                $_SESSION['user'] = $user_login->lastname;
                $_SESSION['user_session'] = session_id();
                header('Location: /home/track');
            }
        }
        @include_once APP_PATH . 'view/home_index.tpl.php';
    }

    /**
     * Register page for user.
     */
    function action_register() {
        $msg = FALSE;
        $jobs = model_job::getAllJobs();
        if (isset($_POST['btn-register'])) {
            $nume = $_POST['form']['nume'];
            $prenume = $_POST['form']['prenume'];
            $email = $_POST['form']['email'];
            $password = $_POST['form']['password'];
            $confirmPassword = $_POST['form']['confirmPass'];
            $job = $_POST['form']['job'];

            if ($password != $confirmPassword) {
                $msg = TRUE;
            }
            else {
                try {
                    $user = model_user::addUser($nume, $prenume, $email, $password, $job);
                    header('Location: login');
                } catch (Exception $e) {
                    header('Location: /500/index');
                }
            }
        }
        @include_once APP_PATH . 'view/user_register.tpl.php';
    }

    function action_track() {
        if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
            $_SESSION['logged'] = false;
            header('Location: /home/login');
        } else {
            $_SESSION['logged'] = true;
            // Include view for this page
            @include_once APP_PATH . 'view/track_page.tpl.php';
        }
    }

    function action_logout() {
        session_destroy();
        header('Location: /home/login');
    }
}
