<?php

declare(strict_types=1);

namespace MarekSkopal\MsPricing\ViewHelpers;

use MarekSkopal\MsPricing\Domain\Model\PlanFeature;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class CellValueViewHelper extends AbstractViewHelper
{
    /** @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingAnyTypeHint */
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        $this->registerArgument('planFeature', PlanFeature::class, 'The plan feature record', false, null);
    }

    public function render(): string
    {
        /** @var PlanFeature|null $planFeature */
        $planFeature = $this->arguments['planFeature'];

        if ($planFeature === null) {
            return '<span aria-label="Not included">&ndash;</span>';
        }

        return match ($planFeature->getValueType()) {
            'available' => '<svg class="mspricing-check" aria-label="Included" role="img" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><polyline points="2,8 6,12 14,4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            'unlimited' => '<span aria-label="Unlimited">&infin;</span>',
            'text' => '<span>' . htmlspecialchars($planFeature->getValueText()) . '</span>',
            default => '<span aria-label="Not included">&ndash;</span>',
        };
    }
}
