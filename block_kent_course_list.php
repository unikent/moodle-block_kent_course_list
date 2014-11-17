<?php

include_once($CFG->dirroot . '/blocks/course_list/block_course_list.php');

/**
 * Deprecated
 */
class block_kent_course_list extends block_course_list {

    function init() {
        $this->title = get_string('blocktitle', 'block_kent_course_list');
    }

    function has_config() {
        return false;
    }
}
