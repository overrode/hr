<?php

/**
 * Controller for homepage and general pages.
 */
class controller_home {

    /**
     * This is the homepage.
     */
    function action_index($params) {
        // Include view for this page
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

            if (empty($login_email)) {
                $form_error = "Please insert e-mail!";
                header('Location: login');
            }
            elseif (empty($login_password)) {
                $form_error = "Please insert password!";
                header('Location: login');
            }

            $user_login = model_user::getByEmail($login_email);
            //die($user_login);
            $password_validate = $user_login->checkPassword($login_password);

            if (!empty($user_login) && $password_validate) {
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
        $jobs = model_job::getAllJobs();

        if (isset($_POST['btn-register'])) {
            $user_data = array(
                'lastname' => $_POST['form']['lastname'],
                'firstname' => $_POST['form']['firstname'],
                'email' => $_POST['form']['email'],
                'password' => $_POST['form']['password'],
                'confirmPassword' => $_POST['form']['confirmPass'],
                'job' => $_POST['form']['job'],
            );
            $form_errors = array(
                'emailMessage' => '',
                'errorEmail' => FALSE,
                'errorPassword' => FALSE,
                'errorConfirmPass' => FALSE,
                'errorLastName' => FALSE,
                'errorFirstName'  => FALSE,
                'isPasswordNotMatching' => FALSE,
                );

            $emailDomain = model_user::validateEmailDomain($user_data['email']);
            $emailExist = model_user::isEmailRegistered($user_data['email']);
            $displayError = FALSE;

            // Check if user's email exists.
            if ($emailExist) {
                $form_errors['emailMessage'] = "This email is already registered.";
                $displayError = TRUE;
            }
            // Check user's email domain.
            if (!$emailDomain) {
                $form_errors['emailMessage'] = "Your email should end with @freshbyteinc.com";
                $form_errors['errorEmail'] = TRUE;
                $displayError = TRUE;
            }
            // Check if passwords match.
            if ($user_data['password'] != $user_data['confirmPassword']) {
                $form_errors['isPasswordNotMatching'] = TRUE;
                $displayError = TRUE;
                $form_errors['errorPassword'] = TRUE;
                $form_errors['errorConfirmPass']= TRUE;
            }
            // Check if user's lastname is set.
            if (empty($user_data['lastname'])) {
                $form_errors['errorLastName'] = TRUE;
                $displayError = TRUE;
            }
            //  Check if user's firstname is set.
            if (empty($user_data['firstname'])) {
                $form_errors['errorFirstName'] = TRUE;
                $displayError = TRUE;
            }
            // Check if user's email is set.
            if (empty($user_data['email'])) {
                $form_errors['errorEmail'] = TRUE;
                $displayError = TRUE;
            }
            //Check if user's password is set.
            if (empty($user_data['password'])) {
                $form_errors['errorPassword'] = TRUE;
                $displayError = TRUE;
            }
            //Check if user's confirm password is set.
            if (empty($user_data['confirmPassword'])) {
                $form_errors['errorConfirmPass'] = TRUE;
                $displayError = TRUE;
            }
            // If there are no errors displayed, attempt to add the user.
            if (!$displayError) {
                if ($user = model_user::addUser(
                    $user_data['lastname'],
                    $user_data['firstname'],
                    $user_data['email'],
                    $user_data['password'],
                    $user_data['job']
                )) {
                    header('Location: login');
                }
                else {
                    header('Location: register');
                }
            }
        }
        @include_once APP_PATH . 'view/user_register.tpl.php';
    }

    function action_track() {
        @include_once APP_PATH . 'view/track_page.tpl.php';
    }
}
