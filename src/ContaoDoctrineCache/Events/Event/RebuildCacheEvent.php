<?php

namespace ContaoDoctrineCache\Events\Event;

use Symfony\Component\EventDispatcher\Event;

class RebuildCacheEvent extends Event
{

    const NAME = 'contao.doctrinecache.rebuild';

    protected $callerParameter;

    public function __construct($callerParameter)
    {
        $this->callerParameter = $callerParameter;
    }

    /**
     * @return mixed
     */
    public function getCallerParameter()
    {
        return $this->callerParameter;
    }

    /**
     * @param mixed $callerParameter
     *
     * @return SaveCallbackEvent
     */
    public function setCallerParameter($callerParameter)
    {
        $this->callerParameter = $callerParameter;
        return $this;
    }
}
