<?php

/**
 * Controller for homepage and general pages.
 */
class controller_home {

    /**
     * Generate homepage.
     */
    function action_index() {
        //header('Location: /');
        // Include view for this page.
        @include_once APP_PATH . 'view/home_index.tpl.php';
    }

    /**
     * Login page for user.
     */
    public function action_login() {
        // Checks email and passwordfor validation.
        if (isset($_POST['form']['action'])) {

            // Saving form values in variables.
            $login_email = $_POST['form']['user'];
            $login_password = $_POST['form']['password'];

            $user_login = model_user::getByEmail($login_email);
            $user_email = $user_login->email;

            // Caching the form errors.
            $form_error = array(
                'no_email' => empty($login_email) ? "Please insert your email!" : FALSE,
                'no_password' => empty($login_password) ? "Please insert your password!" : FALSE,
                'wrong_email' => ($user_email != $login_email) ? "Wrong e-mail!" : FALSE,
                'wrong_password' => (!empty($login_password) && $user_login->password) ? "Wrong password!" : FALSE,
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
        $jobs = model_job::getAllJobs();
        $displayError = FALSE;

        if (isset($_POST['btn-register'])) {
            $user_data = array(
                'lastname' => model_user::sanitizeInput($_POST['form']['lastname']),
                'firstname' => model_user::sanitizeInput($_POST['form']['firstname']),
                'email' => $_POST['form']['email'],
                'password' => $_POST['form']['password'],
                'confirmPassword' => $_POST['form']['confirmPass'],
                'job' => $_POST['form']['job'],
            );

            $form_errors = array(
                'emailMessage' => '',
                'limitMessage' => '',
                'errorEmail' => FALSE,
                'errorPassword' => FALSE,
                'errorConfirmPass' => FALSE,
                'errorLastName' => FALSE,
                'errorFirstName' => FALSE,
                'isPasswordNotMatching' => FALSE,
            );

            // Check user's lastname and firstname.
            model_user::validateUserName($form_errors, $user_data, $displayError);

            // Check user's email.
            model_user::validateUserEmail($form_errors, $user_data, $displayError);

            // Check user's password and user's confirm password.
            model_user::validatePassword($form_errors, $user_data, $displayError);

            // If there are no errors displayed, attempt to add the user.
            if (!$displayError) {
                try {
                    $user = model_user::addUser(
                        $user_data['lastname'],
                        $user_data['firstname'],
                        $user_data['email'],
                        $user_data['password'],
                        $user_data['job']
                    );
                    header('Location: /home/login');
                } catch (Exception $e) {
                    header('Location: /500/index');
                }
            }
        }
        @include_once APP_PATH . 'view/user_register.tpl.php';
    }

    /**
     * This is the track page.
     *
     * @include the track view template
     */
    function action_track() {
        if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
            $_SESSION['logged'] = FALSE;
            header('Location: /home/login');
        }
        else {
            $_SESSION['logged'] = TRUE;
            // Include view for this page.
            @include_once APP_PATH . 'view/track_page.tpl.php';
        }
    }

    /**
     * This is the logout page.
     *
     */
    function action_logout() {
        session_destroy();
        header('Location: /home/login');
    }

    /**
     * This is the track page.
     *
     * @include the track view template
     */
    function action_userLogged() {
        if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
            $_SESSION['logged'] = false;
            header('Location: /');
        } else {
            $_SESSION['logged'] = true;
            header('Location: /home/track');
            // Include view for this page.
            @include_once APP_PATH . 'view/track_page.tpl.php';
        }
    }

}
