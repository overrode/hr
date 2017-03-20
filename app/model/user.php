<?php

/**
 * Class model_user
 */
class model_user {

    public $id;
    public $lastname;
    public $firstname;
    public $email;
    public $password;
    public $job;

    /**
     * Model_user constructor.
     *
     * @param string $model_user
     */
    public function __construct($model_user) {
        $this->id = $model_user['id'];
        $this->lastname = $model_user['lastname'];
        $this->firstname = $model_user['firstname'];
        $this->email = $model_user['email'];
        $this->password = $model_user['password'];
        $this->job = $model_user['job'];
    }

    /**
     * Retrieve an user by id.
     *
     * @param int $id
     *   The users id.
     *
     * @return bool|model_user
     *   Returns FALSE on fail, model_user on success.
     *
     * @throws Exception
     */
    public static function getById($id) {
        $db = model_database::instance();
        $sql = 'SELECT user.id, user.firstname, user.lastname, user.email, user.password, job.job
         FROM users user join jobs job on job.jobs_id= user.jobs_id WHERE id= :id';
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        try {
            $result = $query->fetch();
            if ($result) {
                $user = new model_user($result);
            }
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return isset($user) ? $user : FALSE;
    }

    /**
     * Retrieve an user by email.
     *
     * @param string $email
     *
     * @return FALSE|model_user
     *   Returns FALSE on fail, model_user on success.
     *
     * @throws Exception
     */
    public static function getByEmail($email) {
        $db = model_database::instance();
        $sql = 'SELECT user.id, user.firstname, user.lastname, user.email, user.password, job.job FROM users user
                JOIN jobs job ON job.jobs_id= user.jobs_id WHERE email = :email';
        $query = $db->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();
        try {
            $result = $query->fetch();
            if ($result) {
                $user = new model_user($result);
            }
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return isset($user) ? $user : FALSE;
    }

    /**
     * Add a new user in database.
     *
     * @param string $lastname
     *    The users name.
     * @param string $firstname
     *    The users firstname.
     * @param string $email
     *    The users email.
     * @param string $password
     *    The users password.
     * @param string $job
     *    The users job.
     *
     * @return bool
     *   Returns FALSE on fail, TRUE otherwise.
     *
     * @throws \Exception
     */
    public static function addUser($firstname, $lastname, $email, $password, $job) {
        $password = self::hashPassword($password);
        $db = model_database::instance();
        $jobs = model_job::getByJob($job);
        $id_job = $jobs->getId();
        try {
            $sql = $db->prepare('INSERT INTO users(id,firstname,lastname,email,password,jobs_id) VALUES (NULL,?,?,?,?,?)');
            $result = $sql->execute([
                $firstname,
                $lastname,
                $email,
                $password,
                $id_job
            ]);
        } catch (PDOException  $e) {
            throw new Exception(DB_ERROR);
        }
        return $result;
    }

    /**
     * Update a user by id.
     *
     * @param int $id
     *   The users id.
     * @param string $lastname
     *   The users lastname.
     * @param string $firstname
     *   The users firstname.
     * @param string $email
     *   The users email.
     * @param string $password
     *   The users password.
     * @param string $job
     *   The users job.
     *
     * @return bool
     *   Returns FALSE on fail, TRUE otherwise.
     *
     * @throws \Exception
     */
    public static function updateUser($id, $lastname, $firstname, $email, $password, $job) {
        $password = self::hashPassword($password);
        $db = model_database::instance();
        try {
            $sql = $db->prepare('UPDATE users SET firstname = ?, lastname = ?, email= ?, password= ?, jobs_id=? WHERE id= ?');
            $sql->execute([
                $lastname,
                $firstname,
                $email,
                $password,
                $job,
                $id
            ]);
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return TRUE;
    }

    /**
     * Delete an user by id.
     *
     * @param int $id
     *
     * @return bool
     *   Returns FALSE on fail, TRUE otherwise.
     *
     * @throws Exception
     */
    public static function deleteUser($id) {
        $db = model_database::instance();
        try {
            $sql = $db->prepare('DELETE FROM users WHERE id= ?');
            $sql->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return TRUE;
    }

    /**
     * Check password.
     *
     * @param String $password
     *
     * @return bool
     *   Returns TRUE if the password and hash match, or FALSE otherwise.
     */
    public function checkPassword($password) {
        $hash_password = $this->password;
        $password_hash = hash('sha256', $password);
        return password_verify($password_hash, $hash_password);
    }

    /**
     * Hash the password.
     *
     * @param String $param
     *   The user's password.
     *
     * @return string|bool
     *   Returns the hashed password, or FALSE on failure.
     */
    private static function hashPassword($param) {
        $option = ['cost' => PASSWORD_COST];
        return password_hash(hash('sha256', $param), PASSWORD_DEFAULT, $option);
    }

    /**
     * Validate the email.
     *
     * @param string $email
     *   The user's email.
     *
     * @return bool
     *   Returns FALSE on fail, TRUE otherwise.
     */
    public static function validateEmailDomain($email) {
        $val = preg_match('/^.+@freshbyteinc\.com$/i', $email);
        return $val > 0 ? TRUE : FALSE;
    }

    /**
     * Check if a email exists in db.
     *
     * @param String $email
     *   The users email.
     *
     * @return bool
     *   Return FALSE on fail, TRUE otherwise.
     *
     * @throws Exception
     */
    public static function isEmailRegistered($email) {
        $db = model_database::instance();
        $sql = 'SELECT user.id, user.firstname, user.lastname, user.email, user.password, job.job FROM users user
                join jobs job ON job.jobs_id= user.jobs_id WHERE email = :email';
        $query = $db->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();
        try {
            $result = $query->fetch();
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return $result ? TRUE : FALSE;
    }

    /**
     * Check for the user's input length.
     *
     * @param String $str
     *   The user's input.
     * @param String $min
     *   The minimum value for an accepted string.
     * @param String $max
     *    The maximum value for an accepted string.
     *
     * @return bool
     *   Return TRUE on success, FALSE on fail.
     */
    public static function limitString($str, $min, $max) {
        $length = strlen($str);
        if (($length < $min) || ($length > $max)) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Sanitize the user's input.
     *
     * @param $value
     *   The user's input.
     *
     * @return string
     *   Return the sanitize user's input.
     */
    public static function sanitizeInput($value) {
        // Remove empty spaces.
        $value = trim($value);
        // Strip any whitespace
        $value = preg_replace('/\s+/', '', $value);
        // Remove html tags
        $value = strip_tags($value);
        return $value;
    }

    /**
     * Check if the string contains only letters.
     *
     * @param String $string
     *   The user's input.
     *
     * @return bool
     *   Return TRUE on success, FALSE on fail.
     */
    public static function validateString($string) {
        return ctype_alpha($string) ? TRUE : FALSE;
    }

    /**
     * Check if passwords match.
     *
     * @param array $form_errors
     *   The form errors.
     * @param array $user_data
     *   The user data.
     * @param boolean $display_error
     *   The error display flag.
     */
    public static function confirmUserPassword(&$form_errors, &$user_data, &$display_error) {
        if ($user_data['password'] != $user_data['confirmPassword']) {
            $form_errors['isPasswordNotMatching'] = TRUE;
            $form_errors['errorPassword'] = TRUE;
            $form_errors['errorConfirmPass'] = TRUE;
            $display_error = TRUE;
        }
    }

    /**
     * Check user's lastname and firstname.
     *
     * @param array $form_errors
     *   The form errors.
     * @param array $user_data
     *   The user data.
     * @param boolean $display_error
     *   The error display flag.
     */
    public static function validateUserName(&$form_errors, &$user_data, &$display_error) {
        // Check if user's lastname is set.
        if (empty($user_data['lastname'])) {
            $form_errors['errorLastName'] = TRUE;
            $display_error = TRUE;
        }
        else {
            $limitLastName = model_user::limitString($user_data['lastname'], 2, 15);
            $lastNameContainsOnlyLetters = model_user::validateString($user_data['lastname']);

            // Check if user's lastname contains only letters.
            if (!$lastNameContainsOnlyLetters) {
                $form_errors['errorLastName'] = TRUE;
                $form_errors['limitMessage'] = 'The lastname & firstname can contain only letters.';
                $display_error = TRUE;
            }
            else {
                // Check if the lastname has the precise limit.
                if (!$limitLastName) {
                    $form_errors['errorLastName'] = TRUE;
                    $form_errors['limitMessage'] = 'The input should be between 2 & 15 characters!';
                    $display_error = TRUE;
                }
                else {
                    $form_errors['errorLastName'] = FALSE;
                }
            }
        }

        // Check if user's firstname is set.
        if (empty($user_data['firstname'])) {
            $form_errors['errorFirstName'] = TRUE;
            $display_error = TRUE;
        }
        else {
            $limitFirstName = model_user::limitString($user_data['firstname'], 2, 15);
            $firstNameContainsOnlyLetters = model_user::validateString($user_data['firstname']);

            // Check if user's firstname contains only letters.
            if (!$firstNameContainsOnlyLetters) {
                $form_errors['errorFirstName'] = TRUE;
                $form_errors['limitMessage'] = 'The lastname & firstname can contain only letters!';
                $display_error = TRUE;
            }
            else {
                // Check if the firstname has the precise limit.
                if (!$limitFirstName) {
                    $form_errors['errorFirstName'] = TRUE;
                    $form_errors['limitMessage'] = 'The input should be between 2 & 15 characters!';
                    $display_error = TRUE;
                }
                else {
                    $form_errors['errorFirstName'] = FALSE;
                }
            }
        }
    }

    /**
     * Validate user email.
     *
     * @param array $form_errors
     *   The form errors.
     * @param array $user_data
     *   The user data.
     * @param boolean $display_error
     *   The error display flag.
     */
    public static function validateUserEmail(&$form_errors, &$user_data, &$display_error){
        // Check if user's email is set.
        if (empty($user_data['email'])) {
            $form_errors['errorEmail'] = TRUE;
            $display_error = TRUE;
        }
        // Check if user's email exists.
        $emailDomain= model_user::validateEmailDomain($user_data['email']);
        $emailExist = model_user::isEmailRegistered($user_data['email']);

        if ($emailExist) {
            $form_errors['emailMessage'] = "This email is already registered.";
            $display_error = TRUE;
        }
        // Check user's email domain.
        if (!$emailDomain) {
            $form_errors['emailMessage'] = "Your email should end with @freshbyteinc.com.";
            $form_errors['errorEmail'] = TRUE;
            $display_error = TRUE;
        }
    }

    /**
     * Validates the user's password and checks if passwords match.
     *
     * @param array $form_errors
     *   The form errors.
     * @param array $user_data
     *   The user data.
     * @param boolean $display_error
     *   The error display flag.
     */
    public static function validatePassword(&$form_errors, &$user_data, &$display_error){
        // Check if user's password is set.
        if (empty($user_data['password'])) {
            $form_errors['errorPassword'] = TRUE;
            $display_error = TRUE;
        }
        // Check if user's confirm password is set.
        if (empty($user_data['confirmPassword'])) {
            $form_errors['errorConfirmPass'] = TRUE;
            $display_error = TRUE;
        }
        // Check if passwords match.
        if ($user_data['password'] != $user_data['confirmPassword']) {
            $form_errors['isPasswordNotMatching'] = TRUE;
            $form_errors['errorPassword'] = TRUE;
            $form_errors['errorConfirmPass'] = TRUE;
            $display_error = TRUE;
        }
    }
}