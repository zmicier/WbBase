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
    use WbTrait\Service\ServiceDelegatorTrait;

    public function __construct(ServiceInterface $service, EventManagerInterface $eventManager)
    {
        $this->setService($service);
        $this->setEventManager($eventManager);
    }

    public function __call($method, $args)
    {
        $this->getEventManager()->trigger($method . ':pre', $this, $args);
        call_user_func_array($this->getService(), $args);
        $this->getEventManager()->trigger($method . ':post', $this, $args);
    }
}
