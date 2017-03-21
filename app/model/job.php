<?php

/**
 * Class model_job
 */
class model_job {

    /**
     * @var int $id
     *   Retuns job's id.
     */
    public $id;

    /**
     * @var string $name
     *   Returns job's name.
     */
    public $name;

    /**
     * @return int
     *   Returns the job id.
     */
    function getId() {
        return $this->id;
    }

    /**
     * @return string
     *   Returns the job name.
     */
    function getName() {
        return $this->name;
    }

    /**
     * model_job constructor.
     *
     * @param string $model_job
     */
    public function __construct($model_job) {
        $this->id = $model_job['jobs_id'];
        $this->name = $model_job['job'];
    }

    /**
     * Retrieves a job by id.
     *
     * @param int $id
     *   The users id.
     *
     * @return FALSE|model_job
     *    Returns FALSE on fail, model_job on success.
     *
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
     *
     * @param string $name
     *   The users name.
     *
     * @return FALSE|\model_job
     *   Returns FALSE on fail, model_job on success.
     *
     * @throws Exception
     */
    public static function getByJob($name) {
        $db = model_database::instance();
        $sql = 'select * from jobs where job = :nume';
        $query = $db->prepare($sql);
        $query->bindValue(':nume', $name);
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

    /**
     * Retrieves all jobs.
     *
     * @return FALSE|array
     *   Returns FALSE on fail, array otherwise.
     *
     * @throws Exception
     */
    public static function getAllJobs(){
        $db = model_database::instance();
        $sql = 'select * from jobs';
        $query = $db->prepare($sql);
        $query->execute();
        try{
            while($result = $query->fetch()){
                $val[] = $result;
            }
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return isset($val) ? $val : FALSE;
    }

}
