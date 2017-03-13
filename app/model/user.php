<?php

/**
 * Class model_user
 */
class model_user {

    var $id;
    var $lastname;
    var $firstname;
    var $email;
    var $password;
    var $job;

    /**
     * model_user constructor.
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
     * Function used to validate the users data.
     *
     * @param string $email
     *   The users email.
     * @param string $password
     *   The users password.
     *
     * @return bool
     *   Returns FALSE on fail, TRUE otherwise.
     */
    public static function validate($email, $password) {
        //$password will can be used after the encryption part is ready
        if ($result = self::getByEmail($email)) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Retrieves an user by id.
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
        $sql = 'select user.id, user.nume, user.prenume, user.email, user.password, job.job
         from users user join jobs job on job.jobs_id= user.jobs_id where id= :id';
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
     * Retrieves an user by email.
     *
     * @param string $email
     *
     * @return FALSE|model_user
     *   Returns FALSE on fail, model_user on success.
     *
     * @throws \Exception
     */
    public static function getByEmail($email) {
        $db = model_database::instance();
        $sql = 'select user.id, user.nume, user.prenume, user.email, user.password, job.job from users user
                join jobs job on job.jobs_id= user.jobs_id where email = :email';
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
     * Adds a new user in database.
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
    public static function addUser($lastname, $firstname, $email, $password, $job) {
        $db = model_database::instance();
        try {
            $sql = $db->prepare('insert into users(id,nume,prenume,email,password,jobs_id) VALUES (NULL,?,?,?,?,?)');
            $result = $sql->execute([$lastname, $firstname, $email, $password, $job]);
        } catch (PDOException  $e) {
            throw new Exception(DB_ERROR);
        }
        return $result;
    }

    /**
     * Updates a user by id.
     *
     * @param int $id
     *    The users id.
     * @param string $lastname
     *    The users lastname.
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
    public static function updateUser($id, $lastname, $firstname, $email, $password, $job) {
        $db = model_database::instance();
        try {
            $sql = $db->prepare('update users set nume = ?, prenume = ?, email= ?, password= ?, jobs_id=? where id= ?');
            $sql->execute([$lastname, $firstname, $email, $password, $job, $id]);
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return FALSE;
    }

    /**
     * Deletes an user by id.
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
            $sql = $db->prepare('delete from users where id= ?');
            $sql->execute([$id]);
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return FALSE;
    }
}