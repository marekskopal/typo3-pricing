<?php

declare(strict_types=1);

return [
    'ctrl' => [
        'title' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan',
        'label' => 'name',
        'sortby' => 'sorting',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'iconfile' => 'EXT:ms_pricing/Resources/Public/Icons/Extension.svg',
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    ['label' => '', 'invertStateDisplay' => true],
                ],
            ],
        ],
        'name' => [
            'label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan.name',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'subtitle' => [
            'label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan.subtitle',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'price_monthly' => [
            'label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan.price_monthly',
            'config' => [
                'type' => 'number',
                'format' => 'decimal',
                'nullable' => true,
            ],
        ],
        'price_yearly' => [
            'label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan.price_yearly',
            'config' => [
                'type' => 'number',
                'format' => 'decimal',
                'nullable' => true,
            ],
        ],
        'currency' => [
            'label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan.currency',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'max' => 10,
                'eval' => 'trim',
                'default' => '$',
            ],
        ],
        'css_class' => [
            'label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan.css_class',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'plan_features' => [
            'label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan.plan_features',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_mspricing_domain_model_planfeature',
                'foreign_field' => 'plan',
                'foreign_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => false,
                    'expandSingle' => true,
                    'newRecordLinkAddTitle' => true,
                    'levelLinksPosition' => 'bottom',
                    'useSortable' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                    'enabledControls' => [
                        'info' => true,
                        'new' => true,
                        'dragdrop' => true,
                        'sort' => false,
                        'hide' => true,
                        'delete' => true,
                        'localize' => true,
                    ],
                ],
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    name, subtitle, currency, price_monthly, price_yearly, css_class,
                --div--;LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan.tab.features,
                    plan_features,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    hidden
            ',
        ],
    ],
];
