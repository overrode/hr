<?php
/**
 * Work model.
 */
class model_work {

    public $id_work;
    public $date;
    public $project;
    public $task;
    public $details;
    public $user_id;

    /**
     * model_user constructor.
     * @param $model_user
     */
    public function __construct($model_work) {
        $this->id_work = $model_work['id_work'];
        $this->date = $model_work['date'];
        $this->project = $model_work['project'];
        $this->task = $model_work['task'];
        $this->details = $model_work['details'];
        $this->user_id = $model_work['user_id'];
    }

    /**
     * Adds a new work in database.
     * @param $date type date
     * @param $project string project
     * @param $task string task
     * @param $details string details
     * @param $user_id int user_id
     * @throws \Exception
     */
    public static function createWork($date, $project, $task, $details, $user_id) {
        $db = model_database::instance();
        $sql = "INSERT INTO `work`(`date`, `project`, `task`, `details`, `user_id`) VALUES (?, ?, ?, ?, ?)";
        try {
            $db->prepare($sql)->execute([$date, $project, $task, $details, $user_id]);
        } catch(PDOException $e) { echo $e->getMessage(); }
    }

    /**
     * Retrieves work by id.
     * @param $user_id int id
     * @return bool|model_user
     * @throws \Exception
     */
    public static function getWork($user_id) {
        $db = model_database::instance();
        $sql = 'SELECT * FROM work WHERE user_id = ' . intval($user_id);
        try {

            if ($result = $db->getRow($sql)) {
                $work = new model_work();
                $work->id_work = $result['id_work'];
                $work->date = $result['date'];
                $work->project = $result['project'];
                $work->task = $result['task'];
                $work->details = $result['details'];
                return $work;
            }
            return FALSE;
        } catch(PDOException $e) { echo $e->getMessage(); }
    }

    /**
     * Updates work.
     * @param $date type date
     * @param $project string project
     * @param $task string task
     * @param $details string details
     * @param $user_id int user_id
     * @throws \Exception
     */
    public static function updateWork($date, $project, $task, $details, $id_work) {
        $db = model_database::instance();
        $sql = "UPDATE work SET date = ?, project = ?, task = ?, details = ? WHERE id_work = ?";
        try {
            $db->prepare($sql)->execute([$date, $project, $task, $details, $id_work]);
        } catch(PDOException $e) { echo $e->getMessage(); }
    }

    /**
     * Delete work by id.
     * @param $id_work int id_work
     * @throws \Exception
     */
    public static function deleteWork($id_work) {
        $db = model_database::instance();
        $sql = "DELETE FROM work WHERE `id_work` = " . intval($id_work);
        try {
            $db->prepare($sql)->execute();
        } catch(PDOException $e) { echo $e->getMessage(); }
    }


}