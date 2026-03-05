<?php

declare(strict_types=1);

namespace MarekSkopal\MsPricing\Controller;

use MarekSkopal\MsPricing\Service\PricingTableService;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class PricingController extends ActionController
{
    public function __construct(private readonly PricingTableService $pricingTableService)
    {
    }

    public function tableAction(): ResponseInterface
    {
        $plans = $this->pricingTableService->getPlans();

        $this->view->assign('plans', $plans);
        $this->view->assign('groups', $this->pricingTableService->getGroups($plans));

        return $this->htmlResponse();
    }
}
