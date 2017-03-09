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
     * Retrieves an user by id.
     * @param $id int id
     * @return FALSE or a valid user object
     */
    public static function getById($id) {
        $db = model_database::instance();
        $sql = 'select user.id, user.nume, user.prenume, user.email, user.password, job.job
         from users user join jobs job on job.jobs_id= user.jobs_id where id=' . intval($id);
        try {
            if ($result = $db->getRow($sql)) {
                $user = new model_user();
                $user->id = $result['id'];
                $user->nume = $result['nume'];
                $user->prenume = $result['prenume'];
                $user->email = $result['email'];
                $user->password = $result['password'];
                $user->job = $result['job'];
                return $user;
            }
        }catch(PDOException $e){
            $e->getMessage();
        }
        return FALSE;
    }

    /**
     * Retrieves an user by email.
     * @param $email string email
     * @return FALSE or a valid user object
     */
    public static function getByEmail($email) {
        $db = model_database::instance();
        $sql = 'select user.id, user.nume, user.prenume, user.email, user.password, job.job from users user
                join jobs job on job.jobs_id= user.jobs_id where email = ' . "'$email'";
        try {
            if ($result = $db->getRow($sql)) {
                $user = new model_user();
                $user->id = $result['id'];
                $user->nume = $result['nume'];
                $user->prenume = $result['prenume'];
                $user->email = $result['email'];
                $user->password = $result['password'];
                $user->job = $result['job'];
                return $user;
            }
        }catch (PDOException $e){
            $e->getMessage();
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
     * @return boolean
     */
    public static function addUser($nume, $prenume, $email, $password, $job){
        $db = model_database::instance();
        try {
            $sql = $db->prepare('insert into users(id,nume,prenume,email,password,jobs_id) VALUES (NULL,?,?,?,?,?)');
            $sql->execute([$nume, $prenume,$email,$password, $job]);
        }catch (PDOException  $e){
            $e->getMessage();
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
     * @return boolean
     */
    public static function updateUser($id, $nume, $prenume, $email, $password, $job){
        $db = model_database::instance();
        try{
            $sql = $db->prepare('update users set nume = ?, prenume = ?, email= ?, password= ?, jobs_id=? where id= ?');
            $sql->execute([$nume, $prenume, $email, $password, $job, $id ]);
        }catch(PDOException $e){
            $e->getMessage();
        }
        return FALSE;
    }

    /**
     * Deletes an user by id.
     * @param $id int id
     * @return boolean
     */
    public static function deleteUser($id){
        $db = model_database::instance();
        try{
            $sql = $db->prepare('delete from users where id= ?');
            $sql->execute([$id]);
        }catch(PDOException $e){
            $e->getMessage();
        }
        return FALSE;
    }
}