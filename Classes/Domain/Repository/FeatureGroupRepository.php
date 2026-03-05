<?php

declare(strict_types=1);

namespace MarekSkopal\MsPricing\Domain\Repository;

use MarekSkopal\MsPricing\Domain\Model\FeatureGroup;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/** @extends Repository<FeatureGroup> */
class FeatureGroupRepository extends Repository
{
    /** @return QueryResultInterface<int, FeatureGroup> */
    public function findAllOrdered(): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->setOrderings(['sorting' => QueryInterface::ORDER_ASCENDING]);
        return $query->execute();
    }
}
