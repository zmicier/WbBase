<?php

namespace WbBase\Service\Delegator\Strategy;

/**
 * AbstractStrategy 
 * 
 * @uses StrategyInterface
 * @author Źmicier Hryškieivič <zmicier@webbison.com> 
 */
abstract class AbstractStrategy implements StrategyInterface
{
    /**
     * Delegators list
     * 
     * @var string[]
     */
    protected $delegators = array();

    /**
     * init 
     * 
     * @return void
     */
    public function init()
    {
        $defaultDelegators = array(
            'ExceptionDelegator'
        );
        $this->setDelegators($defaultDelegators);

    }

    /**
     * Is delegator applicable for selected strategy.
     * 
     * @param string $serviceName serviceName 
     * 
     * @return boolean
     */
    public function isApplicable($serviceName)
    {
        return in_array($serviceName, $this->getDelegators());
    }

    /**
     * Delegators setter. 
     * 
     * @param string $delegators delegators 
     * 
     * @return self
     */
    public function setDelegators($delegators)
    {
        $this->delegators = $delegators;
        return $this;
    }

    /**
     * Adds delegator to list
     * 
     * @param string $delegatorName
     * 
     * @return self
     */
    public function addDelegator($delegatorName)
    {
        $this->delegators[] = $delegatorName;
        return $this;
    }

    /**
     * Appends delegators to list
     * 
     * @param array $delegators
     * 
     * @return self
     */
    public function addDelegators($delegators)
    {
        $this->delegators = array_merge($this->delegators, $delegators);
        return $this;
    }

    /**
     * Delegators getter
     * 
     * @return string[]
     */
    public function getDelegators()
    {
        return $this->delegators;
    }
}
