<?php
/**
 * Created by PhpStorm.
 * User: Freshbyte01
 * Date: 3/8/2017
 * Time: 6:05 AM
 */

class model_job{

    var $id;
    var $nume;

    /**
     * Retrieves a job by id.
     * @param $id int id
     * @return FALSE or a valid job object
     */
    public static function getById($id) {
        $db = model_database::instance();
        $sql = 'select * from jobs where jobs_id = ' . intval($id);
        if ($result = $db->getRow($sql)) {
            $job = new model_job();
            $job->id = $result['jobs_id'];
            $job->nume = $result['job'];
            return $job;
        }
        return FALSE;
    }

    /**
     * Retrieves a job by name.
     * @param $nume string nume
     * @return FALSE or a valid job object
     */
    public static function getByJob($nume) {
        $db = model_database::instance();
        $sql = 'select * from jobs where job = ' . "'$nume'";
        if ($result = $db->getRow($sql)) {
            $job = new model_job();
            $job->id = $result['jobs_id'];
            $job->nume = $result['job'];
            return $job;
        }
        return FALSE;
    }
}