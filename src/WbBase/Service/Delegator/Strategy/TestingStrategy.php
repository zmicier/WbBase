<?php

namespace WbBase\Service\Delegator\Strategy;

class TestingStrategy extends AbstractStrategy implements StrategyInterface
{

    public function init()
    {
        parent::init();

        $productionDelegators = array(
            'EventDelegator',
            'AclDelegator',
            'DebugDelegator',
        );

        $this->addDelegators($productionDelegators);
    }
}
