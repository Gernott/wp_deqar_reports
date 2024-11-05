<?php
defined('TYPO3') || die('Access denied.');

call_user_func(
    function () {
        $GLOBALS['TYPO3_CONF_VARS']['BE']['stylesheets']['wp_deqar_reports']
            = 'EXT:wp_deqar_reports/Resources/Public/Css/select2.min.css';
    }
);
