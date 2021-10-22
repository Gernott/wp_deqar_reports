<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'WEBprofil.WpDeqarReports',
            'Deqar',
            [
                'Report' => 'getInstitutions'
            ],
            // non-cacheable actions
            [
                'Report' => 'getInstitutions'
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'WEBprofil.WpDeqarReports',
            'Deqarreports',
            [
                'Report' => 'plugin'
            ],
            // non-cacheable actions
            [
                'Report' => ''
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
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

        $iconRegistry->registerIcon(
            'wp_deqar_reports-plugin-deqar',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:wp_deqar_reports/Resources/Public/Icons/user_mod_deqar.svg']
        );

    }
);
