<?php
namespace WbBase\Service\Delegator;

use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WbBase\Service\Delegator\StrategyAwareInterface;

class ExceptionDelegatorFactory implements
    DelegatorFactoryInterface,
    DelegatorStrategyAwareInterface,
    ListenerStrategyAwareInterface,
    EventManagerAwareInterface
{
    use WbTrait\EventManager\EventManagerAwareTrait;
    use WbTrait\Service\DelegatorStrategyAwareTrait;

    const DELEGATOR_NAME = "ExceptionDelegator";

    public function createDelegatorWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName, $callback)
    {
        $service = call_user_func($callback);
        if ($this->getDelegatorStrategy()->isApplicable(self::DELEGATOR_NAME)) {
            return Service\Delegator\self::DELEGATOR_NAME($service, $eventManager);
        }
        return $service;
    }
}
