<?php
defined('TYPO3') || die('Access denied.');

call_user_func(
    function () {

        if (TYPO3_MODE === 'BE') {
        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wpdeqarreports_domain_model_report',
            'EXT:wp_deqar_reports/Resources/Private/Language/locallang_csh_tx_wpdeqarreports_domain_model_report.xlf');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wpdeqarreports_domain_model_program',
            'EXT:wp_deqar_reports/Resources/Private/Language/locallang_csh_tx_wpdeqarreports_domain_model_program.xlf');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wpdeqarreports_domain_model_decision',
            'EXT:wp_deqar_reports/Resources/Private/Language/locallang_csh_tx_wpdeqarreports_domain_model_decision.xlf');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wpdeqarreports_domain_model_activity',
            'EXT:wp_deqar_reports/Resources/Private/Language/locallang_csh_tx_wpdeqarreports_domain_model_activity.xlf');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_wpdeqarreports_domain_model_membership',
            'EXT:wp_deqar_reports/Resources/Private/Language/locallang_csh_tx_wpdeqarreports_domain_model_membership.xlf');

    }
);
