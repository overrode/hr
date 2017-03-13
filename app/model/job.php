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
     * model_job constructor.
     * @param $model_job
     */
    public function __construct($model_job) {
        $this->id = $model_job['jobs_id'];
        $this->nume = $model_job['job'];
    }

    /**
     * Retrieves a job by id.
     * @param $id int id
     * @return FALSE|model_job
     * @throws Exception
     */

    public static function getById($id) {
        $db = model_database::instance();
        $sql = 'select * from jobs where jobs_id = :id';
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        try{
            $result = $query->fetch();
            if ($result) {
                $job = new model_job($result);
            }
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return isset($job) ? $job : FALSE;
    }

    /**
     * Retrieves a job by name.
     * @param $nume string nume
     * @return FALSE|\model_job
     * @throws Exception
     */
    public static function getByJob($nume) {
        $db = model_database::instance();
        $sql = 'select * from jobs where job = :nume';
        $query = $db->prepare($sql);
        $query->bindValue(':nume', $nume);
        $query->execute();
        try {
            $result = $query->fetch();
            if ($result) {
                $job = new model_job($result);
            }
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return isset($job) ? $job : FALSE;
    }
}