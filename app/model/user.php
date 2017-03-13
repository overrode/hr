<?php
/**
 * Created by PhpStorm.
 * User: Freshbyte01
 * Date: 3/8/2017
 * Time: 6:06 AM
 */

class model_user{

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
     * @param $id int id
     * @return bool
     */
    public static function checkPassword($text, $id) {
        $db = model_database::instance();
        $sql = 'select * from test_security where id = ' .intval($id);
        try {
            $db->prepare($sql)->execute();
            $result = $db->getRow($sql);
        } catch(PDOException $e) { echo $e->getMessage(); }
        $hash_password = $result['password'];
        $text = hash('sha256', $text);
        if ( password_verify($text, $hash_password) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Hases the password.
     * @param $param string password
     */
    private function hashPassword($param) {
        $option = ['cost' => PASSWORD_COST];
        return password_hash(hash('sha256', $param), PASSWORD_DEFAULT, $option);
    }

}