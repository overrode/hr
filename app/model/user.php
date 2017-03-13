<?php
/**
 * Created by PhpStorm.
 * User: Freshbyte01
 * Date: 3/8/2017
 * Time: 6:06 AM
 */

class model_user{

    public $id;
    public $nume;
    public $prenume;
    public $email;
    public $password;
    public $job;

    /**
     * model_user constructor.
     * @param $model_user
     */
    public function __construct($model_user) {
        $this->id = $model_user['id'];
        $this->nume = $model_user['nume'];
        $this->prenume = $model_user['prenume'];
        $this->email = $model_user['email'];
        $this->password = $this->hashPassword($model_user['password']);
        $this->job = $model_user['job'];
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
        }
        catch (PDOException $e) {
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
            $user = new model_user($result);
        }catch (PDOException $e){
            throw new Exception(DB_ERROR);
        }
        return $user;
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
    public static function addUser($nume, $prenume, $email, $password, $job){
        $password = self::hashPassword($password);
        $db = model_database::instance();
        try {
            $sql = $db->prepare('insert into users(id,nume,prenume,email,password,jobs_id) VALUES (NULL,?,?,?,?,?)');
            $sql->execute([$nume, $prenume,$email,$password, $job]);
        }catch (PDOException  $e){
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
    public static function updateUser($id, $nume, $prenume, $email, $password, $job){
        $password = self::hashPassword($password);
        $db = model_database::instance();
        try{
            $sql = $db->prepare('update users set nume = ?, prenume = ?, email= ?, password= ?, jobs_id=? where id= ?');
            $sql->execute([$nume, $prenume, $email, $password, $job, $id ]);
        }catch(PDOException $e){
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
    public static function deleteUser($id){
        $db = model_database::instance();
        try{
            $sql = $db->prepare('delete from users where id= ?');
            $sql->execute([$id]);
        }catch(PDOException $e){
            throw new Exception(DB_ERROR);
        }
        return FALSE;
    }

    /**
     * Check password
     * @param $text string text
     * @return bool
     */
    public function checkPassword($password) {
        $hash_password = $this->password;
        $password = hash('sha256', $password);
        return password_verify($password, $hash_password);
    }

    /**
     * Hases the password.
     * @param $param string password
     * @return string hash password
     */
    private static function hashPassword($param) {
        $option = ['cost' => PASSWORD_COST];
        return password_hash(hash('sha256', $param), PASSWORD_DEFAULT, $option);
    }

}