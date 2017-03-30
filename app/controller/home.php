<?php

/**
 * Controller for homepage and general pages.
 */
class controller_home {

    /**
     * Generate homepage.
     */
    function action_index() {
        if(model_user::userLoggedIn()) {
            header('Location: /home/track');
        }
        // Include view for this page.
        @include_once APP_PATH . 'view/home_index.tpl.php';
    }

    /**
     * Login page for user.
     */
    public function action_login() {
        if(model_user::userLoggedIn()) {
            header('Location: /home/track');
        }
        // Checks email and passwordfor validation.
        if (isset($_POST['form']['action'])) {

            // Saving form values in variables.
            $form_data = array(
                'login_email' => $_POST['form']['user'],
                'login_password' => $_POST['form']['password'],
            );

            $user_login = model_user::getByEmail( $form_data['login_email']);
            $user_email = $user_login->email;

            // Caching the form errors.
            $form_error = array(
                'no_email' => empty($form_data['login_email']) ? "Please insert your email!" : FALSE,
                'no_password' => empty($form_data['login_password']) ? "Please insert your password!" : FALSE,
                'wrong_email' => ($user_email != $form_data['login_email']) ? "Wrong e-mail or password!" : FALSE,
                'wrong_password' => (!empty($form_data['login_password']) && $user_login->password) ? "Wrong email or password!" : FALSE,
            );
            if ($user_email === $form_data['login_email'] && $user_login->checkPassword($form_data['login_password'])) {
                $_SESSION['user'] = $user_email;
                $_SESSION['id'] = $user_login->id;
                header('Location: /home/track');
            }
        }
        @include_once APP_PATH . 'view/home_index.tpl.php';
    }

    /**
     * Register page for user.
     */
    function action_register() {
        if(model_user::userLoggedIn()) {
            header('Location: /home/track');
        }
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

                    $user_login = model_user::getByEmail( $user_data['email']);
                    $user_email = $user_login->email;

                    $_SESSION['user'] = $user_email;
                    $_SESSION['id'] = $user_login->id;

                    header('Location: /home/track');
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
        if(model_user::userLoggedIn()) {
         //    Include view for this page.
            @include_once APP_PATH . 'view/track_page.tpl.php';
        } else {
            header('Location: /home/login');
        }
    }

    /**
     * This is the logout page.
     * Destroy all session variable.
     */
    function action_logout() {
        session_unset();
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
