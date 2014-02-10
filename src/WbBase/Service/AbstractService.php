<?php

namespace WbBase\Service;

use WbBase\WbTrait;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Abstract service
 *
 * @uses ServiceInterface
 * @author Źmicier Hryškieivič <zmicier@webbison.com>
 */
abstract class AbstractService implements
    ServiceInterface,
    ServiceLocatorInterface
{
    use WbTrait\ServiceManager\ServiceLocatorAwareTrait;
    use WbTrait\EventManager\EventManagerAwareTrait;
}
