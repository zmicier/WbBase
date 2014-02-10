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
class ExceptionDelegator extends AbstractService implements EventManagerInterface
{
    use WbTrait\EventManager\EventManagerAwareTrait;
    use WbTrait\Service\ServiceDelegatorTrait;

    const DELEGATOR_NAME = "ExceptionDelegator";

    public function __construct(ServiceInterface $service, EventManagerInterface $eventManager)
    {
        $this->setService($service);
        $this->setEventManager($eventManager);
    }

    public function __call($method, $args)
    {
        if ($this->getDelegatorStrategy()->isApplicable(self::DELEGATOR_NAME)) {
            try {
                call_user_func_array(
                    array($this->getService(), $method),
                    $args
                );
            } catch (Service\ExceptionInterface $e) {
                throw $e;
            } catch (WbBase\Model\ExceptionInterface $e) {
                throw new Service\Exception\ModelException('Model error occured: ' . $e->getMessage());
            } catch (Exception $e) {
                throw new Service\Exception\Internal('Internal error occured: ' . $e->getMessage());
            }
        }
    }
}
