<?php

/**
 * Created by PhpStorm.
 * User: Freshbyte01
 * Date: 3/8/2017
 * Time: 6:06 AM
 */
class model_user {

    var $id;
    var $nume;
    var $prenume;
    var $email;
    var $password;
    var $job;

    /**
     * model_user constructor.
     * @param $model_user
     */
    public function __construct($model_user) {
        $this->id = $model_user['id'];
        $this->nume = $model_user['nume'];
        $this->prenume = $model_user['prenume'];
        $this->email = $model_user['email'];
        $this->password = $model_user['password'];
        $this->job = $model_user['job'];
    }

    /**
     * @param $email email
     * @param $password password
     * @return bool
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
     * @param $id int id
     * @return bool|model_user
     * @throws \Exception
     * @internal param $model_user
     * @internal param int $id id
     */
    public static function getById($id) {
        $db = model_database::instance();
        $sql = 'select user.id, user.nume, user.prenume, user.email, user.password, job.job
         from users user join jobs job on job.jobs_id= user.jobs_id where id=' . intval($id);
        try {
            $result = $db->getRow($sql);
            $user = new model_user($result);
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return $user;
    }

    /**
     * Retrieves an user by email.
     * @param $email string email
     * @return FALSE|model_user
     * @throws \Exception
     */
    public static function getByEmail($email) {
        $db = model_database::instance();
        $sql = 'select user.id, user.nume, user.prenume, user.email, user.password, job.job from users user
                join jobs job on job.jobs_id= user.jobs_id where email = ' . "'$email'";
        try {
            $result = $db->getRow($sql);
            if ($result) {
                $user = new model_user($result);
            }
            return $user;

        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return FALSE;
    }

    /**
     * Adds a new user in database.
     * @param $nume string nume
     * @param $prenume string prenume
     * @param $email string email
     * @param $password string password
     * @param $job string job
     * @return bool
     * @throws \Exception
     */
    public static function addUser($nume, $prenume, $email, $password, $job) {
        $db = model_database::instance();
        try {
            $sql = $db->prepare('insert into users(id,nume,prenume,email,password,jobs_id) VALUES (NULL,?,?,?,?,?)');
            $sql->execute([$nume, $prenume, $email, $password, $job]);
        } catch (PDOException  $e) {
            throw new Exception(DB_ERROR);
        }
        return FALSE;
    }

    /**
     * Updates a user by id.
     * @param $id int id
     * @param $nume string nume
     * @param $prenume string prenume
     * @param $email string email
     * @param $password string password
     * @param $job string job
     * @return bool
     * @throws \Exception
     */
    public static function updateUser($id, $nume, $prenume, $email, $password, $job) {
        $db = model_database::instance();
        try {
            $sql = $db->prepare('update users set nume = ?, prenume = ?, email= ?, password= ?, jobs_id=? where id= ?');
            $sql->execute([$nume, $prenume, $email, $password, $job, $id]);
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return FALSE;
    }

    /**
     * Deletes an user by id.
     * @param $id int id
     * @return bool
     * @throws \Exception
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