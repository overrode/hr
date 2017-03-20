<?php

/**
 * Controller for homepage and general pages.
 */
class controller_home {

    /**
     * Generate homepage.
     */
    function action_index($params) {
        header('Location: /home/login');
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
                $form_errors['emailMessage'] = "Your email should end with @freshbyteinc.com.";
                $form_errors['errorEmail'] = TRUE;
                $displayError = TRUE;
            }
            // Check if passwords match.
            if ($user_data['password'] != $user_data['confirmPassword']) {
                $form_errors['isPasswordNotMatching'] = TRUE;
                $displayError = TRUE;
                $form_errors['errorPassword'] = TRUE;
                $form_errors['errorConfirmPass'] = TRUE;
            }
            // Check if user's lastname is set.
            if (empty($user_data['lastname'])) {
                $form_errors['errorLastName'] = TRUE;
                $displayError = TRUE;
            }
            else {
                $limitLastName = model_user::limitString($user_data['lastname'], 2, 15);
                $containsOnlyLetters = model_user::validateString($user_data['lastname']);
                // Check if user's lastname contains only letters.
                if (!$containsOnlyLetters) {
                    $form_errors['errorLastName'] = TRUE;
                    $form_errors['limitMessage'] = 'The lastname & firstname can contain only letters.';
                    $displayError = TRUE;
                }
                else {
                    // Check if the lastname has the precise limit.
                    if (!$limitLastName) {
                        $form_errors['errorLastName'] = TRUE;
                        $form_errors['limitMessage'] = 'The input should be between 2 & 15 characters!';
                        $displayError = TRUE;
                    }
                    else {
                        $form_errors['errorLastName'] = FALSE;
                    }
                }
            }
            // Check if user's firstname is set.
            if (empty($user_data['firstname'])) {
                $form_errors['errorFirstName'] = TRUE;
                $displayError = TRUE;
            }
            else {
                $limitFirstName = model_user::limitString($user_data['firstname'], 2, 15);
                $containsOnlyLetters = model_user::validateString($user_data['firstname']);
                // Check if user's firstname contains only letters.
                if (!$containsOnlyLetters) {
                    $form_errors['errorFirstName'] = TRUE;
                    $form_errors['limitMessage'] = 'The lastname & firstname can contain only letters!';
                    $displayError = TRUE;
                }
                else {
                    // Check if the firstname has the precise limit.
                    if (!$limitFirstName) {
                        $form_errors['errorFirstName'] = TRUE;
                        $form_errors['limitMessage'] = 'The input should be between 2 & 15 characters!';
                        $displayError = TRUE;
                    }
                    else {
                        $form_errors['errorFirstName'] = FALSE;
                    }
                }
            }
            // Check if user's email is set.
            if (empty($user_data['email'])) {
                $form_errors['errorEmail'] = TRUE;
                $displayError = TRUE;
            }
            // Check if user's password is set.
            if (empty($user_data['password'])) {
                $form_errors['errorPassword'] = TRUE;
                $displayError = TRUE;
            }
            // Check if user's confirm password is set.
            if (empty($user_data['confirmPassword'])) {
                $form_errors['errorConfirmPass'] = TRUE;
                $displayError = TRUE;
            }

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

    function action_logout() {
        session_destroy();
        header('Location: /home/login');
    }
}
