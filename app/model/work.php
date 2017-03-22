<?php

/**
 * Work model.
 */
class model_work {

    /**
     * @var int $id_work
     *   Returns work's id.
     */
    public $id_work;

    /**
     * @var int $date
     *   Returns work's date.
     */
    public $date;

    /**
     * @var string $project
     *   Returns work's project.
     */
    public $project;

    /**
     * @var string $task
     *   Returns work's task.
     */
    public $task;

    /**
     * @var string $details
     *   Returns work's details.
     */
    public $details;

    /**
     * @var int $user_id
     *   Returns user's id.
     */
    public $hours;
    public $user_id;

    /**
     * Model_user constructor.
     *
     * @param string $model_work
     */
    public function __construct($model_work) {
        $this->id_work = $model_work['id_work'];
        $this->date = $model_work['date'];
        $this->project = $model_work['project'];
        $this->task = $model_work['task'];
        $this->details = $model_work['details'];
        $this->hours = $model_work['hours'];
        $this->user_id = $model_work['user_id'];
    }

    /**
     * Add a new work in database.
     *
     * @param type date $date
     *   The work date.
     * @param string $project
     *   The work project.
     * @param string $task
     *   The work task.
     * @param string $details
     *   The work detail.
     * @param int $user_id
     *   The work id.
     * @return bool
     * @throws \Exception
     */
    public static function createWork($date, $project, $task, $hours, $details, $user_id) {
        $db = model_database::instance();
        $sql = "INSERT INTO `work`(`date`, `project`, `task`, `hours`,`details`, `user_id`) VALUES (?, ?, ?, ?, ?, ?)";
        try {
            $result = $db->prepare($sql)->execute([
                $date,
                $project,
                $task,
                $hours,
                $details,
                $user_id
            ]);
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return $result;
    }

    /**
     * Retrieve work by id.
     *
     * @param $user_id int id
     *   The user's id.
     *
     * @return bool|model_user
     *   Return model_user in case of SUCCESS, FALSE otherwise.
     *
     * @throws Exception
     */
    public static function getWork($user_id) {
        $db = model_database::instance();
        try {
            $sql = 'SELECT * FROM work WHERE user_id = :id';
            $query = $db->prepare($sql);
            $query->bindValue(':id', $user_id);
            $query->execute();
            if ($result = $query->fetch()) {
                $work = new model_work($result);
            }
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
        return isset($work) ? $work : FALSE;
    }

    /**
     * Update work.
     *
     * @param type date $date
     *   The work date.
     * @param string $project
     *   The work project.
     * @param string $task
     *   The work task.
     * @param string $details
     *   The work detail.
     * @param int $id_work
     *   The work id.
     *
     * @throws Exception
     */
    public static function updateWork($date, $project, $task, $details, $id_work) {
        $db = model_database::instance();
        $sql = "UPDATE work SET date = ?, project = ?, task = ?, details = ? WHERE id_work = ?";
        try {
            $db->prepare($sql)->execute([
                $date,
                $project,
                $task,
                $details,
                $id_work
            ]);
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
    }

    /**
     * Delete work by id.
     *
     * @param int $id_work
     *   The work id.
     *
     * @throws Exception
     */
    public static function deleteWork($id_work) {
        $db = model_database::instance();
        $sql = "DELETE FROM work WHERE `id_work` = " . intval($id_work);
        try {
            $db->prepare($sql)->execute();
        } catch (PDOException $e) {
            throw new Exception(DB_ERROR);
        }
    }

    /**
     * Check if the string contains only digits.
     *
     * @param String $string
     *   The user's input.
     *
     * @return bool
     *   Return TRUE on success, FALSE on fail.
     */
    public static function validateStringDigits($string) {
        return ctype_digit($string) ? TRUE : FALSE;
    }

    /**
     * Check user's input.
     *
     * @param array $form_errors
     *   The form errors.
     * @param $project_data
     * @param boolean $display_error
     *   The error display flag.
     * @internal param array $user_data The user data.*   The user data.
     */
    public static function validateInput(&$form_errors, &$project_data, &$display_error) {
        // Check if user's lastname is set.
        if (empty($project_data['project'])) {
            $form_errors['errorProject'] = TRUE;
            $display_error = TRUE;
        }
        else {
            $projectContainsOnlyDigits = model_work::validateStringDigits($project_data['project']);

            // Check if user's project contains only digits.
            if (!$projectContainsOnlyDigits) {
                $form_errors['errorProject'] = TRUE;
                $display_error = TRUE;
            }
            else {
                $form_errors['errorLastName'] = FALSE;
            }
        }
    }
}
