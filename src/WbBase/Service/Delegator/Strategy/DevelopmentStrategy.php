<?php

namespace WbBase\Service\Delegator\Strategy;

class DevelopmentStrategy extends AbstractStrategy implements StrategyInterface
{

    public function init()
    {
        parent::init();

        $productionDelegators = array(
            'EventDelegator',
            'AclDelegator',
        );

        $this->addDelegators($productionDelegators);
    }
}
