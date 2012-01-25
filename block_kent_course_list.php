<?php

include_once($CFG->dirroot . '/course/lib.php');
include_once($CFG->dirroot . '/blocks/course_list/block_course_list.php');
require_once($CFG->dirroot . '/blocks/kent_course_overview/lib.php'); //Leverage functions from kent course overview to get archive links

class block_kent_course_list extends block_course_list {

    function init() {
        $this->title = get_string('pluginname', 'block_kent_course_list');
    }

    function has_config() {
        return true;
    }

    function get_content() {

        global $CFG;

        $output = parent::get_content();

        //If we are in Archive moodle mode then lets add some links
        if(isset($CFG->archive_moodle) && ($CFG->archive_moodle == TRUE)){

            //Override the footer link if we are in archive mode with something more suitable.
            if($output->items[0] != get_string('nocoursesyet')){

                $link_text = (kent_is_archive_moodle() ? get_string('archive_moodle_old_text','block_kent_course_list') : get_string('archive_moodle_current_text','block_kent_course_list'));

                if (has_capability('moodle/course:update', get_context_instance(CONTEXT_SYSTEM)) || empty($CFG->block_course_list_hideallcourseslink)) {
                    $output->footer = "<a href=\"$CFG->wwwroot/course/index.php\">".$link_text.'</a> ...';
                }
            }

            //Now time to stick in our archive links....

            //Firstly .. provide link back to Current Moodle, if I am the archive moodle!
            if (kent_is_archive_moodle()){
                $render_link = '<span class="kent_course_list_archive_top">&raquo; '.kent_archive_moodle_link().'</span>';
                array_unshift($output->items, $render_link);
            }

            //Or... provide link back to Archive Moodle if switched on
            if (!kent_is_archive_moodle()){
                $render_link = '<span class="kent_course_list_archive_bottom">&raquo; '.kent_archive_moodle_link().'</span>';
                array_push($output->items, $render_link);
            }
        }

        //Now lets return our modified object
        return $output;
        
    }

}


