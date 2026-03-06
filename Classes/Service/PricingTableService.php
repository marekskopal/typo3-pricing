<?php

declare(strict_types=1);

namespace MarekSkopal\MsPricing\Service;

use MarekSkopal\MsPricing\Domain\Model\Feature;
use MarekSkopal\MsPricing\Domain\Model\FeatureGroup;
use MarekSkopal\MsPricing\Domain\Model\Plan;
use MarekSkopal\MsPricing\Domain\Model\PlanFeature;
use MarekSkopal\MsPricing\Domain\Repository\FeatureGroupRepository;
use MarekSkopal\MsPricing\Domain\Repository\FeatureRepository;
use MarekSkopal\MsPricing\Domain\Repository\PlanFeatureRepository;
use MarekSkopal\MsPricing\Domain\Repository\PlanRepository;
use MarekSkopal\MsPricing\Dto\FeatureRowDto;
use MarekSkopal\MsPricing\Dto\PricingGroupDto;

class PricingTableService
{
    public function __construct(
        private readonly PlanRepository $planRepository,
        private readonly FeatureGroupRepository $featureGroupRepository,
        private readonly FeatureRepository $featureRepository,
        private readonly PlanFeatureRepository $planFeatureRepository,
    ) {
    }

    /** @return list<Plan> */
    public function getPlans(): array
    {
        /** @var list<Plan> $plans */
        $plans = $this->planRepository->findAllOrdered()->toArray();
        return $plans;
    }

    /**
     * @param list<Plan> $plans
     * @return list<PricingGroupDto>
     */
    public function getGroups(array $plans): array
    {
        /** @var list<FeatureGroup> $featureGroups */
        $featureGroups = $this->featureGroupRepository->findAllOrdered()->toArray();

        /** @var list<Feature> $features */
        $features = $this->featureRepository->findAllOrdered()->toArray();

        $lookup = $this->buildLookup($plans);

        return $this->buildGroups($features, $featureGroups, $lookup);
    }

    /**
     * @param list<Plan> $plans
     * @return array<int, array<int, PlanFeature>>
     */
    private function buildLookup(array $plans): array
    {
        $lookup = [];

        foreach ($plans as $plan) {
            $planUid = $plan->getUid();
            if ($planUid === null) {
                continue;
            }

            $l10nParent = $plan->getL10nParent();
            $originalPlanUid = $l10nParent !== 0 ? $l10nParent : $planUid;

            foreach ($this->planFeatureRepository->findByPlanUid($originalPlanUid) as $planFeature) {
                $feature = $planFeature->getFeature();
                if ($feature === null) {
                    continue;
                }

                $featureL10nParent = $feature->getL10nParent();
                $featureUid = $featureL10nParent !== 0 ? $featureL10nParent : $feature->getUid();
                if ($featureUid === null) {
                    continue;
                }

                $lookup[$featureUid][$planUid] = $planFeature;
            }
        }

        return $lookup;
    }

    /**
     * @param list<Feature> $features
     * @param list<FeatureGroup> $featureGroups
     * @param array<int, array<int, PlanFeature>> $lookup
     * @return list<PricingGroupDto>
     */
    private function buildGroups(array $features, array $featureGroups, array $lookup): array
    {
        /** @var array<string, PricingGroupDto> $groupsMap */
        $groupsMap = [];

        foreach ($features as $feature) {
            $group = $feature->getFeatureGroup();
            $groupKey = $group !== null ? (string) $group->getUid() : '0';

            if (!isset($groupsMap[$groupKey])) {
                $groupsMap[$groupKey] = new PricingGroupDto(group: $group, features: []);
            }

            $featureL10nParent = $feature->getL10nParent();
            $featureUid = $featureL10nParent !== 0 ? $featureL10nParent : $feature->getUid();
            $values = $featureUid !== null ? ($lookup[$featureUid] ?? []) : [];

            $groupsMap[$groupKey] = new PricingGroupDto(
                group: $groupsMap[$groupKey]->group,
                features: [...$groupsMap[$groupKey]->features, new FeatureRowDto(feature: $feature, values: $values)],
            );
        }

        $orderedGroups = isset($groupsMap['0']) ? [$groupsMap['0']] : [];
        unset($groupsMap['0']);

        foreach ($featureGroups as $featureGroup) {
            $uid = (string) $featureGroup->getUid();
            if (isset($groupsMap[$uid])) {
                $orderedGroups[] = $groupsMap[$uid];
            }
        }

        return $orderedGroups;
    }
}
