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
     * Create work.
     */
    public static function createWork($date, $project, $task, $details, $user_id) {
        $db = model_database::instance();
        try {
            $sql = "INSERT INTO `work`(`date`, `project`, `task`, `details`, `user_id`) VALUES (?, ?, ?, ?, ?)";
            $db->prepare($sql)->execute([$date, $project, $task, $details, $user_id]);
        } catch(PDOException $e) { echo $e->getMessage(); }
    }

    /**
     * Read work by ID.
     */
    public static function getWork($user_id) {
        $db = model_database::instance();
        try {
            $sql = 'SELECT * FROM work WHERE user_id = :id';
            $query= $db->prepare($sql);
            $query->bindValue(':id', $user_id);
            $query->execute();
            if ($result = $query->fetch()) {
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
     * Update work.
     */
    public static function updateWork($date, $project, $task, $details, $id_work) {
        $db = model_database::instance();
        try {
            $sql = "UPDATE work SET date = ?, project = ?, task = ?, details = ? WHERE id_work = ?";
            $db->prepare($sql)->execute([$date, $project, $task, $details, $id_work]);
        } catch(PDOException $e) { echo $e->getMessage(); }
    }

    /**
     * Delete work by id.
     */
    public static function deleteWork($id_work) {
        $db = model_database::instance();
        try {
            $sql = "DELETE FROM work WHERE `id_work` = " . intval($id_work);
            $db->prepare($sql)->execute();
        } catch(PDOException $e) { echo $e->getMessage(); }
    }
}