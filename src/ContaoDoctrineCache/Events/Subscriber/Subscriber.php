<?php

/**
 * The Postmanager allows you to manage posts and news in a from the contao core separated system
 *
 * PHP version 5
 *
 * @package    PostManager
 * @subpackage PostManager
 * @author     Christopher Boelter <c.boelter@revision6.de>
 * @copyright  Revision6 UG
 * @license    LGPL.
 * @filesource
 */

namespace PostManager\DataContainer\Events\Table;

use Contao\Input;
use ContaoDoctrineCache\Events\Event\FlushCacheEvent;
use PostManager\IPostManagerServiceContainer;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * The BaseSubscriber for extended all other subscriber.
 *
 * @package PostManager\DataContainer\Events\Table
 */
class Subscriber
{


    public function __construct()
    {
        $this->registerEventsInDispatcher();
    }

    /**
     * Register Events in Dispatcher.
     *
     * @return void
     */
    protected function registerEventsInDispatcher()
    {
        $this
            ->addListener(
                FlushCacheEvent::NAME,
                array($this, 'flushCache')
            );
    }

    public function flushCache(FlushCacheEvent $event)
    {
        if (!$event->getCallerType() == 'default') {
            return;
        }
echo"TEST";
        $GLOBALS['container']['doctrine-cache']->flushAll();
        $event->stopPropagation();
    }


    public function addListener($eventName, $listener, $priority = 200)
    {
        $dispatcher = $GLOBALS['container']['event-dispatcher'];
        $dispatcher->addListener($eventName, $listener, $priority);

        return $this;
    }
}
