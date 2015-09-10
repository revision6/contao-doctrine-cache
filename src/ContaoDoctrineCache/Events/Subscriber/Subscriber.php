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

namespace ContaoDoctrineCache\Events\Subscriber;

use ContaoDoctrineCache\Events\Event\FlushCacheEvent;
use ContaoDoctrineCache\Events\Event\RebuildCacheEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * The BaseSubscriber for extended all other subscriber.
 *
 * @package PostManager\DataContainer\Events\Table
 */
class Subscriber implements EventSubscriberInterface
{


    public static function getSubscribedEvents()
    {
        return array(
            FlushCacheEvent::NAME => 'flushCache',
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

    protected function getCache()
    {
        return $GLOBALS['container']['doctrine-cache'];
    }

    protected function getEventDispatcher()
    {
        return $GLOBALS['container']['event-dispatcher'];
    }
}
