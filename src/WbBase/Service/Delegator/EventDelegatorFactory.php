<?php
namespace WbBase\Service;

use Zend\ServiceManager\DelegatorFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WbBase\Service\Delegator\StrategyAwareInterface;

class ServiceEventDelegatorFactory implements
    DelegatorFactoryInterface,
    DelegatorStrategyAwareInterface,
    ListenerStrategyAwareInterface,
    EventManagerAwareInterface
{
    use WbTrait\EventManager\EventManagerAwareTrait;
    use WbTrait\Service\DelegatorStrategyAwareTrait;
    use WbTrait\Service\ListenerStrategyAwareTrait;

    const DELEGATOR_NAME = "EventDelegator";

    public function createDelegatorWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName, $callback)
    {
        $service = call_user_func($callback);

        if ($this->getDelegatorStrategy()->isApplicable(self::DELEGATOR_NAME)) {

            $events = array();
            $methods = get_class_methods($service);
            foreach ($methods as $method) {
                $events = array(
                    $requestedName . '::' . $method . '.pre',
                    $requestedName . '::' . $method . '.post'
                );
            }

            $eventManager = $this->getEventManager();
            $listeners = $this->getListenerStrategy()->getListeners($requestedName);
            foreach ($listeners as $listener) {
                foreach ($events as $event) {
                    if ($listener->isApplicableForEvent($event)) {
                        $eventManager->attach($event, $listener);
                    }
                }
            }

            return Service\Delegator\self::DELEGATOR_NAME($service, $eventManager);
        }

        return $service;
    }
}
