<?php

declare(strict_types=1);

$llPath = 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf';
$table = 'tx_mspricing_domain_model_plan';

return [
    'ctrl' => [
        'title' => $llPath . ':' . $table,
        'label' => 'name',
        'sortby' => 'sorting',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
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
            'label' => $llPath . ':' . $table . '.name',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'subtitle' => [
            'label' => $llPath . ':' . $table . '.subtitle',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'price_monthly' => [
            'label' => $llPath . ':' . $table . '.price_monthly',
            'config' => [
                'type' => 'number',
                'format' => 'decimal',
                'nullable' => true,
            ],
        ],
        'price_yearly' => [
            'label' => $llPath . ':' . $table . '.price_yearly',
            'config' => [
                'type' => 'number',
                'format' => 'decimal',
                'nullable' => true,
            ],
        ],
        'currency' => [
            'label' => $llPath . ':' . $table . '.currency',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'max' => 10,
                'eval' => 'trim',
                'default' => '$',
            ],
        ],
        'css_class' => [
            'label' => $llPath . ':' . $table . '.css_class',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'plan_features' => [
            'label' => $llPath . ':' . $table . '.plan_features',
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
                --div--;' . $llPath . ':' . $table . '.tab.features,
                    plan_features,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    hidden
            ',
        ],
    ],
];
