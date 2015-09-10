<?php

namespace ContaoDoctrineCache\Events\Event;

use Symfony\Component\EventDispatcher\Event;

class FlushCacheEvent extends Event
{

    const NAME = 'contao.doctrinecache.flush';

    protected $callerType;

    protected $callerParameter;

    public function __construct($callerType, $callerParameter)
    {
        $this->callerType      = $callerType;
        $this->callerParameter = $callerParameter;
    }

    /**
     * @return mixed
     */
    public function getCallerType()
    {
        return $this->callerType;
    }

    /**
     * @param mixed $callerType
     *
     * @return SaveCallbackEvent
     */
    public function setCallerType($callerType)
    {
        $this->callerType = $callerType;
        return $this;
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
