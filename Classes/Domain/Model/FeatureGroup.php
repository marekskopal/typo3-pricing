<?php

declare(strict_types=1);

namespace MarekSkopal\MsPricing\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class FeatureGroup extends AbstractEntity
{
    protected string $name = '';

    public function getName(): string
    {
        return $this->name;
    }
}
