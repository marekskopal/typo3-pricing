<?php

declare(strict_types=1);

namespace MarekSkopal\MsPricing\Domain\Repository;

use MarekSkopal\MsPricing\Domain\Model\Feature;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/** @extends Repository<Feature> */
class FeatureRepository extends Repository
{
    /** @return QueryResultInterface<int, Feature> */
    public function findAllOrdered(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->setOrderings([
            'featureGroup.sorting' => QueryInterface::ORDER_ASCENDING,
            'sorting' => QueryInterface::ORDER_ASCENDING,
        ]);
        return $query->execute();
    }
}
