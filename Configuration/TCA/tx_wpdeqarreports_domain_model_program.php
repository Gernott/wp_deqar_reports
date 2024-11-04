<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_program',
        'label' => 'programme_identifier',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'programme_identifier,programme_name_primary,programme_qualification_primary,programme_nqf_level,programme_gf_ehea_level',
        'iconfile' => 'EXT:wp_deqar_reports/Resources/Public/Icons/tx_wpdeqarreports_domain_model_program.svg'
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,programme_identifier,programme_name_primary,programme_qualification_primary,programme_nqf_level,programme_gf_ehea_level,--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,starttime,endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => ['type' => 'language'],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'foreign_table' => 'tx_wpdeqarreports_domain_model_program',
                'foreign_table_where' => 'AND tx_wpdeqarreports_domain_model_program.pid=###CURRENT_PID### AND tx_wpdeqarreports_domain_model_program.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'size' => 13,
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'size' => 13,
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
            ],
        ],

        'programme_identifier' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_program.programme_identifier',
            'config' => [
                'type' => 'number',
                'size' => 4
            ]
        ],
        'programme_name_primary' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_program.programme_name_primary',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true
            ],
        ],
        'programme_qualification_primary' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_program.programme_qualification_primary',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'programme_nqf_level' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_program.programme_nqf_level',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'programme_gf_ehea_level' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_program.programme_gf_ehea_level',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => 'short cycle', 'value' => 0],
                    ['label' => 'first cycle', 'value' => 1],
                    ['label' => 'second cycle', 'value' => 2],
                    ['label' => 'third cycle', 'value' => 3],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],

        'report' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
