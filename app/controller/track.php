<?php

/**
 * Controller for traking work page.
 */
class controller_track {

    /**
     * This is the index action.
     */
    public function action_index() {
        // Include view for this page.
        @include_once APP_PATH . 'view/work_page.tpl.php';
    }

    /**
     * Get work by date.
     */
    public function action_getDate() {
        $date = $_POST['data'];
        $tmpDate = model_work::dateFormat($date);
        $get_work = model_work::getWorkByDate($tmpDate);
        print json_encode($get_work);
    }

    /**
     * Add a work.
     */
    public function action_add() {
        $display_error = FALSE;
        $idWork = $_POST['id_work'];
        $project_data = array(
            'project' => $_POST['project'],
            'task' => $_POST['task'],
            'hours' => $_POST['hours'],
            'dateCurrent' => $_POST['date'],
            'details' => ($_POST['details']),
        );

        $form_errors = array(
            'errorProject' => FALSE,
            'errorTask' => FALSE,
            'errorHours' => FALSE,
            'errorDetails' => FALSE,
        );

        $dateFormat = model_work::dateFormat($project_data['dateCurrent']);
        model_work::validateInput($form_errors, $project_data, $display_error);
        $query = FALSE;
        $success_message = array();    /* Update user's work by work's id */
        if(model_work::getWorkByWorkId($idWork)&& !$display_error) {
            try {
                $query = model_work::updateWork($dateFormat, $project_data['project'], $project_data['task'], $project_data['hours'], $project_data['details'], $idWork);
                $success_message = "Work updated!";
            } catch (Exception $e) {
                header('Location: /500/index');
            }
        }
        /* Create work */
        elseif (!$display_error && $dateFormat) {
            try {
                $query = model_work::createWork(
                    $dateFormat,
                    $project_data['project'],
                    $project_data['task'],
                    $project_data['hours'],
                    $project_data['details'],
                    $_SESSION['id']
                );
                $success_message = "Work added!";
            } catch (Exception $e) {
                header('Location: /500/index');
            }
        }
        if ($query) {
            $return = new stdClass();
            $return->status = 'success';
            $return->work = $success_message;
            $return->getDate = model_work::getWorkByDate($dateFormat);
        }
        else {
            $return = new stdClass();
            $return->status = 'failed';
            $return->message = $form_errors;
        }
        print json_encode($return);
    }
}

