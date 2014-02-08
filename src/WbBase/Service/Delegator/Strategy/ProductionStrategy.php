<?php

namespace WbBase\Service\Delegator\Strategy;

class ProductionStrategy extends AbstractStrategy implements StrategyInterface
{

    public function init()
    {
        parent::init();

        $productionDelegators = array(
            'EventDelegator',
            'ProtectionDelegator',
            'AclDelegator',
        );

        $this->addDelegators($productionDelegators);
    }
}
