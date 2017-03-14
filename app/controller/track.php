<?php

/**
 * Controller for traking of work l pages.
 */
class controller_home {
    public function action_index($params) {

        // Include view for this page
        @include_once APP_PATH . 'view/track_page.tpl.php';
    }
}

