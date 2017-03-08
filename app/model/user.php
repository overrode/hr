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
    var $jobs_id;

    /**
     * Validates user email and password.
     * @param $id
     * @return FALSE or a valid user ID
     * @internal param $email
     * @internal param \Password $password
     * @internal param $user
     * @internal param Username $email
     */
    public static function getById($id) {
        $db = model_database::instance();
        $query = 'SELECT * 
			FROM users 
			WHERE id = ' . intval($id);
        $sql = $db->prepare($query);
        $sql->execute();
        if ($result = $db->get_row($sql)) {
            $user = new model_user();
            $user->id = $result['id'];
            $user->nume = $result['nume'];
            $user->prenume = $result['prenume'];
            $user->email = $result['email'];
            $user->password = $result['password'];
            $user->jobs_id = $result['jobs_id'];
            return $user;
        }
        return FALSE;
    }

}