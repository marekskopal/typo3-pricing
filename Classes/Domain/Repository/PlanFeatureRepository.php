<?php

declare(strict_types=1);

namespace MarekSkopal\MsPricing\Domain\Repository;

use MarekSkopal\MsPricing\Domain\Model\PlanFeature;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/** @extends Repository<PlanFeature> */
class PlanFeatureRepository extends Repository
{
    /** @return QueryResultInterface<int, PlanFeature> */
    public function findByPlanUid(int $planUid): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectSysLanguage(false);
        $query->matching($query->equals('plan', $planUid));
        $query->setOrderings(['sorting' => QueryInterface::ORDER_ASCENDING]);
        return $query->execute();
    }
}
