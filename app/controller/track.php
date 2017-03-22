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

    public function action_getDate() {
        $get_work = model_work::getWork(1);
        return json_encode($get_work);
    }

    /**
     * Add a work.
     */
    public function action_add() {
        $display_error = FALSE;
        if (isset($_POST['submit_work'])) {


            $project_data = array(
                'project' => $_POST['project'],
                'task' => $_POST['task'],
                'hours' => $_POST['hours'],
                'details' => $_POST['details'],
            );

            $form_errors = array(
                'errorProject' => FALSE,
                'errorTask' => FALSE,
                'errorHours' => FALSE,
                'errorDetails' => FALSE,
            );


            model_work::validateInput($form_errors, $project_data, $display_error);

            if (!$display_error) {
                try {
                    $work = model_work::createWork(
                        "2017-12-12 12:12:12",
                        $project_data['project'],
                        $project_data['task'],
                        $project_data['hours'],
                        $project_data['details'],
                        $_SESSION['id']
                    );
                    header('Location: /track/index');
                } catch (Exception $e) {
                    header('Location: /500/index');
                }
           }
        }
        @include_once APP_PATH . 'view/work_page.tpl.php';
    }

}

