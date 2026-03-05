<?php

declare(strict_types=1);

use MarekSkopal\MsPricing\Controller\PricingController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

ExtensionUtility::configurePlugin(
    'MsPricing',
    'Pricing',
    [PricingController::class => 'table'],
    [],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
);
