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

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    deqarreports {
                        iconIdentifier = wp_deqar_reports-plugin-deqar
                        title = LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wp_deqar_reports_deqar.name
                        description = LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wp_deqar_reports_deqar.description
                        tt_content_defValues {
                            CType = list
                            list_type = wpdeqarreports_deqarreports
                        }
                    }
                }
                show = *
            }
       }'
        );

    }
);
