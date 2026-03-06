<?php

declare(strict_types=1);

namespace MarekSkopal\MsPricing\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Plan extends AbstractEntity
{
    protected string $name = '';

    protected string $subtitle = '';

    protected ?float $priceMonthly = null;

    protected ?float $priceYearly = null;

    protected string $currency = '$';

    protected string $cssClass = '';

    protected int $l10nParent = 0;

    /** @var ObjectStorage<PlanFeature> */
    protected ObjectStorage $planFeatures;

    public function __construct()
    {
        $this->planFeatures = new ObjectStorage();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function getPriceMonthly(): ?float
    {
        return $this->priceMonthly;
    }

    public function getPriceYearly(): ?float
    {
        return $this->priceYearly;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getCssClass(): string
    {
        return $this->cssClass;
    }

    public function getL10nParent(): int
    {
        return $this->l10nParent;
    }

    /** @return ObjectStorage<PlanFeature> */
    public function getPlanFeatures(): ObjectStorage
    {
        return $this->planFeatures;
    }
}
