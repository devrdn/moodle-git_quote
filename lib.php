<?php

defined('MOODLE_INTERNAL') || die();

function filter_gitquotes_before_standard_html_head() {
    global $PAGE;

    // Правильный путь к локальному CSS-файлу
    $csspath = new moodle_url('/filter/gitquotes/styles.css');
    $PAGE->requires->css($csspath);
}
