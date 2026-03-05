<?php

declare(strict_types=1);

namespace MarekSkopal\MsPricing\Dto;

use MarekSkopal\MsPricing\Domain\Model\Feature;
use MarekSkopal\MsPricing\Domain\Model\PlanFeature;

final class FeatureRowDto
{
    /** @param array<int, PlanFeature> $values */
    public function __construct(
        public readonly Feature $feature,
        public readonly array $values,
    ) {
    }
}
