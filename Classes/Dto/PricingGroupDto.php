<?php

declare(strict_types=1);

namespace MarekSkopal\MsPricing\Dto;

use MarekSkopal\MsPricing\Domain\Model\FeatureGroup;

final class PricingGroupDto
{
    /** @param list<FeatureRowDto> $features */
    public function __construct(public readonly ?FeatureGroup $group, public readonly array $features,)
    {
    }
}
