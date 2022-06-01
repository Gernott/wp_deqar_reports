<?php
defined('TYPO3') || die('Access denied.');

call_user_func(
    function () {

        if (TYPO3_MODE === 'BE') {

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'WpDeqarReports',
                'web', // Make module a submodule of 'web'
                'deqar', // Submodule key
                '', // Position
                [
                    \WEBprofil\WpDeqarReports\Controller\ReportController::class => 'list,new,create,edit,update,error',

                ],
                [
                    'access' => 'user,group',
                    'icon' => 'EXT:wp_deqar_reports/Resources/Public/Icons/user_mod_deqar.svg',
                    'labels' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_deqar.xlf',
                ]
            );

        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('wp_deqar_reports',
            'Configuration/TypoScript', 'DEQAR Report upload');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wpdeqarreports_domain_model_report',
            'EXT:wp_deqar_reports/Resources/Private/Language/locallang_csh_tx_wpdeqarreports_domain_model_report.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wpdeqarreports_domain_model_report');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wpdeqarreports_domain_model_program',
            'EXT:wp_deqar_reports/Resources/Private/Language/locallang_csh_tx_wpdeqarreports_domain_model_program.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wpdeqarreports_domain_model_program');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wpdeqarreports_domain_model_decision',
            'EXT:wp_deqar_reports/Resources/Private/Language/locallang_csh_tx_wpdeqarreports_domain_model_decision.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wpdeqarreports_domain_model_decision');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wpdeqarreports_domain_model_activity',
            'EXT:wp_deqar_reports/Resources/Private/Language/locallang_csh_tx_wpdeqarreports_domain_model_activity.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wpdeqarreports_domain_model_activity');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wpdeqarreports_domain_model_membership',
            'EXT:wp_deqar_reports/Resources/Private/Language/locallang_csh_tx_wpdeqarreports_domain_model_membership.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_wpdeqarreports_domain_model_membership');

    }
);
