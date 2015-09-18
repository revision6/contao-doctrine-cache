<?php


namespace ContaoDoctrineCache\Events\Subscriber;

use ContaoDoctrineCache\Events\Event\FlushCacheEvent;
use ContaoDoctrineCache\Events\Event\RebuildCacheEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

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
