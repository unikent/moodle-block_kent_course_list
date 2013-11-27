<?php

include_once($CFG->dirroot . '/course/lib.php');
include_once($CFG->dirroot . '/blocks/course_list/block_course_list.php');
require_once($CFG->dirroot . '/blocks/kent_course_overview/lib.php'); // Leverage functions from kent course overview to get archive links

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
