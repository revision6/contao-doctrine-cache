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
use ContaoDoctrineCache\Events\Event\RebuildCacheEvent;
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

    public function flushCache(FlushCacheEvent $flushCacheEvent)
    {
        if (!$flushCacheEvent->getCallerType() == 'default') {
            return;
        }

        $this->getCache()->flushAll();
        $flushCacheEvent->stopPropagation();

        $rebuildCacheEvent = new RebuildCacheEvent($flushCacheEvent->getCallerParameter());
        $dispatcher        = $this->getEventDispatcher();
        $dispatcher->dispatch($rebuildCacheEvent::NAME, $rebuildCacheEvent);

    }

    public function addListener($eventName, $listener, $priority = 200)
    {
        $dispatcher = $this->getEventDispatcher();
        $dispatcher->addListener($eventName, $listener, $priority);

        return $this;
    }

    protected function getCache()
    {
        return $GLOBALS['container']['doctrine-cache'];
    }

    protected function getEventDispatcher()
    {
        $GLOBALS['container']['event-dispatcher'];
    }
}
