<?php

declare(strict_types=1);

return [
    'ctrl' => [
        'title' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang.xlf:tx_mspricing_feature',
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
            'label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang.xlf:tx_mspricing_feature.name',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'max' => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'description' => [
            'label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang.xlf:tx_mspricing_feature.description',
            'config' => [
                'type' => 'text',
                'rows' => 4,
                'cols' => 40,
            ],
        ],
        'feature_group' => [
            'label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang.xlf:tx_mspricing_feature.feature_group',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_mspricing_feature_group',
                'foreign_table_where' => 'ORDER BY tx_mspricing_feature_group.sorting ASC',
                'items' => [
                    ['label' => 'LLL:EXT:ms_pricing/Resources/Private/Language/locallang.xlf:tx_mspricing_feature.feature_group.none', 'value' => 0],
                ],
                'default' => 0,
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    name, description, feature_group,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    hidden
            ',
        ],
    ],
];
