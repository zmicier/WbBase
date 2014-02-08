<?php

namespace WbBase\Service\Delegator;

use Zend\EventManager\EventManagerInterface;
use WbBase\WbTrait;

/**
 * Delegator creating events for service method calls
 * 
 * @uses AbstractService
 * @uses EventManagerInterface
 * @author Źmicier Hryškieivič <zmicier@webbison.com> 
 */
class EventDelegator extends AbstractService implements EventManagerInterface
{
    use WbTrait\EventManager\EventManagerAwareTrait;
    use WbTrait\Service\ServiceProxyTrait;

    public function __construct(ServiceInterface $service, EventManagerInterface $eventManager)
    {
        $this->setService($service);
        $this->setEventManager($eventManager);
    }

    /**
     * Adding events for service method 
     * 
     * @param mixed $method method 
     * @param mixed $args args 
     * 
     * @return void
     */
    public function __call($method, $args)
    {
        $this->getEventManager()->trigger($method . '.pre', $this, $args);
        call_user_func_array($this->getService(), $args);
        $this->getEventManager()->trigger($method . '.post', $this, $args);
    }
}
