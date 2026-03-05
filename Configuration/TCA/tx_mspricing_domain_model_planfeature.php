<?php

declare(strict_types=1);

return [
    'ctrl' => [
        'title' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan_feature',
        'label' => 'feature',
        'sortby' => 'sorting',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'hideTable' => true,
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
        'plan' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'feature' => [
            'label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan_feature.feature',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_mspricing_domain_model_feature',
                'foreign_table_where' => 'ORDER BY tx_mspricing_domain_model_feature.sorting ASC',
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'default' => 0,
            ],
        ],
        'value_type' => [
            'label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan_feature.value_type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan_feature.value_type.available', 'value' => 'available'],
                    ['label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan_feature.value_type.unavailable', 'value' => 'unavailable'],
                    ['label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan_feature.value_type.text', 'value' => 'text'],
                ],
                'default' => 'unavailable',
            ],
        ],
        'value_text' => [
            'label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang_db.xlf:tx_mspricing_plan_feature.value_text',
            'displayCond' => 'FIELD:value_type:=:text',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    feature, value_type, value_text,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    hidden
            ',
        ],
    ],
];
