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

    public function action_getDate($id) {
        $get_work = model_work::getWork(1);
        return json_encode($get_work);
    }

}

