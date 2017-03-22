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
        $get_work = model_work::getWorkByDate($date);
        print json_encode($get_work);
    }

    /**
     * Add a work.
     */
    public function action_add() {
        $displayError = FALSE;
        if (isset($_POST['submit_work'])) {

            $project_data = array(
                'project' => $_POST['project'],
                'task' => $_POST['task'],
                'hours' => $_POST['hours'],
                'dateCurrent' => $_POST['date'],
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
            try {
                $work = model_work::createWork(
                    $project_data['dateCurrent'],
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
        @include_once APP_PATH . 'view/work_page.tpl.php';
    }
}

