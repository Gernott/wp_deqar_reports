<?php

return [
    'web_WpDeqarReportsDeqar' => [
        'parent' => 'web',
        'access' => 'user',
        'iconIdentifier' => 'wp_deqar_reports-plugin-deqar',
        'labels' => 'LLL:EXT:wp_deqar_reports/Resources/Private/Language/locallang_deqar.xlf',
        'extensionName' => 'WpDeqarReports',
        'controllerActions' => [
            \WEBprofil\WpDeqarReports\Controller\ReportController::class => [
                'list',
                'new',
                'create',
                'edit',
                'update',
                'error',
            ],
        ],
    ],
];
