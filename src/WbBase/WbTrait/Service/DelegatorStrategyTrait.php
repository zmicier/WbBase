<?php

namespace WbBase\WbTrait\Service;

use WbBase\Service\Delegator\StrategyInterface;

/**
 * DelegatorStrategyTrait
 *
 * @package WbBase\WbTrait\Service
 * @author  Źmicier Hryškieivič <zmicier@webbison.com>
 */
trait DelegatorStrategyTrait
{

    /**
     * @var StrategyInterface
     */
    protected $delegatorStrategy;

    /**
     * Delegator strategy setter.
     * 
     * @param StrategyInterface $strategy strategy 
     * 
     * @return void
     */
    public function setDelegatorStrategy(StrategyInterface $strategy)
    {
        $this->delegatorStrategy = $strategy;
        return $this;
    }

    /**
     * Delegator strategy getter.
     *
     * @return StrategyInterface
     */
    public function getDelegatorStrategy()
    {
        return $this->delegatorStrategy;
    }
}
