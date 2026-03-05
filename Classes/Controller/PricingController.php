<?php

declare(strict_types=1);

namespace MarekSkopal\MsPricing\Controller;

use MarekSkopal\MsPricing\Domain\Model\Feature;
use MarekSkopal\MsPricing\Domain\Model\FeatureGroup;
use MarekSkopal\MsPricing\Domain\Model\Plan;
use MarekSkopal\MsPricing\Domain\Model\PlanFeature;
use MarekSkopal\MsPricing\Domain\Repository\FeatureGroupRepository;
use MarekSkopal\MsPricing\Domain\Repository\FeatureRepository;
use MarekSkopal\MsPricing\Domain\Repository\PlanRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class PricingController extends ActionController
{
    public function __construct(
        private readonly PlanRepository $planRepository,
        private readonly FeatureGroupRepository $featureGroupRepository,
        private readonly FeatureRepository $featureRepository,
    ) {
    }

    public function tableAction(): ResponseInterface
    {
        /** @var list<Plan> $plans */
        $plans = $this->planRepository->findAllOrdered()->toArray();

        /** @var list<FeatureGroup> $featureGroups */
        $featureGroups = $this->featureGroupRepository->findAllOrdered()->toArray();

        /** @var list<Feature> $features */
        $features = $this->featureRepository->findAllOrdered()->toArray();

        // Build lookup: $lookup[featureUid][planUid] = PlanFeature
        /** @var array<int, array<int, PlanFeature>> $lookup */
        $lookup = [];
        foreach ($plans as $plan) {
            foreach ($plan->getPlanFeatures() as $planFeature) {
                $feature = $planFeature->getFeature();
                if ($feature === null) {
                    continue;
                }
                $featureUid = $feature->getUid();
                $planUid = $plan->getUid();
                if ($featureUid === null || $planUid === null) {
                    continue;
                }
                $lookup[$featureUid][$planUid] = $planFeature;
            }
        }

        // Build groups array indexed by feature group uid (null = no group)
        /** @var array<string, array{group: ?FeatureGroup, features: list<array{feature: Feature, values: array<int, PlanFeature>}>}> $groupsMap */
        $groupsMap = [];

        foreach ($features as $feature) {
            $group = $feature->getFeatureGroup();
            $groupKey = $group !== null ? (string) $group->getUid() : '0';

            if (!isset($groupsMap[$groupKey])) {
                $groupsMap[$groupKey] = [
                    'group' => $group,
                    'features' => [],
                ];
            }

            $featureUid = $feature->getUid();
            $values = [];
            if ($featureUid !== null && isset($lookup[$featureUid])) {
                $values = $lookup[$featureUid];
            }

            $groupsMap[$groupKey]['features'][] = [
                'feature' => $feature,
                'values' => $values,
            ];
        }

        // Sort: no-group entries first, then by feature group order
        $noGroup = isset($groupsMap['0']) ? [$groupsMap['0']] : [];
        unset($groupsMap['0']);

        // Build ordered groups following featureGroups order
        $orderedGroups = $noGroup;
        foreach ($featureGroups as $featureGroup) {
            $uid = (string) $featureGroup->getUid();
            if (isset($groupsMap[$uid])) {
                $orderedGroups[] = $groupsMap[$uid];
            }
        }

        $this->view->assign('plans', $plans);
        $this->view->assign('groups', $orderedGroups);

        return $this->htmlResponse();
    }
}
