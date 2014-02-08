<?php

namespace WbBase\Service\Delegator\Strategy;

interface StrategyInterface
{
    public function isApplicable($service);
}
