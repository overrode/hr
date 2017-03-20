<?php

/**
 * Controller that handles 500 errors.
 */
class controller_500 {

    /**
     * Default action for 500 controller.
     */
    function action_index() {
        // Set a title to be displayed in browser bar.
        $html_head_title = 'Internal Server Error';

        // Include view for this page.
        @include_once APP_PATH . 'view/500_index.tpl.php';
    }

}
