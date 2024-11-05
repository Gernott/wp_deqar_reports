<?php
defined('TYPO3') || die('Access denied.');

call_user_func(
    function () {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'WpDeqarReports',
            'Deqar',
            [
                \WEBprofil\WpDeqarReports\Controller\ReportController::class => 'getInstitutions'
            ],
            // non-cacheable actions
            [
                \WEBprofil\WpDeqarReports\Controller\ReportController::class => 'getInstitutions'
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'WpDeqarReports',
            'Deqarreports',
            [
                \WEBprofil\WpDeqarReports\Controller\ReportController::class => 'plugin'
            ],
            // non-cacheable actions
            [
                \WEBprofil\WpDeqarReports\Controller\ReportController::class => ''
            ]
        );

    }
);
