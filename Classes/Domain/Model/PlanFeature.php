<?php

declare(strict_types=1);

namespace MarekSkopal\MsPricing\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class PlanFeature extends AbstractEntity
{
    protected ?Feature $feature = null;

    protected string $valueType = 'unavailable';

    protected string $valueText = '';

    public function getFeature(): ?Feature
    {
        return $this->feature;
    }

    public function getValueType(): string
    {
        return $this->valueType;
    }

    public function getValueText(): string
    {
        return $this->valueText;
    }
}
