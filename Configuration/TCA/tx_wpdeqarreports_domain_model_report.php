<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report',
        'label' => 'report_id',
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
        'searchFields' => 'report_id,type,agency,activity_local_identifier,status,valid_from,valid_to,ser_report_file,ser_report_name,institution_deqar_id,institution_name,hardcopy,file_original_location,file_display_name,file_report_language,activity,decision,programs',
        'iconfile' => 'EXT:wp_deqar_reports/Resources/Public/Icons/tx_wpdeqarreports_domain_model_report.svg'
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,report_id,type,agency,activity_local_identifier,status,valid_from,valid_to,ser_report_file,ser_report_name,institution_deqar_id,institution_name,hardcopy,file_original_location,file_display_name,file_report_language,activity,decision,programs,--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,starttime,endtime'],
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
                'foreign_table' => 'tx_wpdeqarreports_domain_model_report',
                'foreign_table_where' => 'AND tx_wpdeqarreports_domain_model_report.pid=###CURRENT_PID### AND tx_wpdeqarreports_domain_model_report.sys_language_uid IN (-1,0)',
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

        'report_id' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.report_id',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'type' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => 'I', 'value' => 1],
                    ['label' => 'P', 'value' => 2],
                    ['label' => 'J', 'value' => 3],
                ],
                'size' => 1,
                'maxitems' => 1,
                'required' => true
            ],
        ],
        'agency' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.agency',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true
            ],
        ],
        'activity_local_identifier' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.activity_local_identifier',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => 'part of obligatory EQA system', 'value' => 1],
                    ['label' => 'voluntary', 'value' => 2],
                ],
                'size' => 1,
                'maxitems' => 1,
                'required' => true
            ],
        ],
        'valid_from' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.valid_from',
            'config' => [
                'dbType' => 'date',
                'type' => 'datetime',
                'size' => 7,
                'default' => null,
                'format' => 'date',
                'required' => true,
            ],
        ],
        'valid_to' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.valid_to',
            'config' => [
                'dbType' => 'date',
                'type' => 'datetime',
                'size' => 7,
                'default' => null,
                'format' => 'date',
            ],
        ],
        'ser_report_file' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.ser_report_file',
            'config' => [
                ### !!! Watch out for fieldName different from columnName
                'type' => 'file',
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
                ],
                'maxitems' => 1,
                'overrideChildTca' => ['types' => [
                    '0' => [
                        'showitem' => '
                            --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                        'showitem' => '
                            --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                        'showitem' => '
                            --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                        'showitem' => '
                            --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                        'showitem' => '
                            --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                        'showitem' => '
                            --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                    ]
                ]],
            ],
        ],
        'ser_report_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.ser_report_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'institution_deqar_id' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.institution_deqar_id',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true
            ],
        ],
        'institution_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.institution_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true
            ],
        ],
        'hardcopy' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.hardcopy',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                    ]
                ],
                'default' => 0,
            ]

        ],
        'file_original_location' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.file_original_location',
            'config' => [
                ### !!! Watch out for fieldName different from columnName
                'type' => 'file',
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
                ],
                'maxitems' => 1,
                'minitems' => 1,
                'overrideChildTca' => ['types' => [
                    '0' => [
                        'showitem' => '
                            --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                        'showitem' => '
                            --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                        'showitem' => '
                            --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                        'showitem' => '
                            --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                        'showitem' => '
                            --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                    ],
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                        'showitem' => '
                            --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                    ]
                ]],
            ],
        ],
        'file_display_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.file_display_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true
            ],
        ],
        'file_report_language' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.file_report_language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => '-- Label --', 'value' => 0],
                ],
                'size' => 1,
                'maxitems' => 1,
                'required' => true
            ],
        ],
        'activity' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.activity',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_wpdeqarreports_domain_model_activity',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'decision' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.decision',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_wpdeqarreports_domain_model_decision',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'programs' => [
            'exclude' => true,
            'label' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_db.xlf:tx_wpdeqarreports_domain_model_report.programs',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_wpdeqarreports_domain_model_program',
                'foreign_field' => 'report',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],

        ],

    ],
];
