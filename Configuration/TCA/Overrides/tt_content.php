<?php
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'WpDeqarReports',
    'Deqarreports',
    'Deqar Reports'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['wpdeqarreports_deqarreports'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'wpdeqarreports_deqarreports',
    'FILE:EXT:wp_deqar_reports/Configuration/FlexForms/Configuration.xml'
);