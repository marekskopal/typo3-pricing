<?php

declare(strict_types=1);

namespace MarekSkopal\MsPricing\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Feature extends AbstractEntity
{
    protected string $name = '';

    protected string $description = '';

    protected int $l10nParent = 0;

    protected ?FeatureGroup $featureGroup = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getL10nParent(): int
    {
        return $this->l10nParent;
    }

    public function getFeatureGroup(): ?FeatureGroup
    {
        return $this->featureGroup;
    }
}
