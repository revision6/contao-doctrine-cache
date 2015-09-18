<?php
$GLOBALS['TL_EVENT_SUBSCRIBERS'][] = new \ContaoDoctrineCache\Events\Subscriber\Subscriber();

$GLOBALS['TL_CONFIG']['doctrineCacheTtl'] = 450;

$GLOBALS['CONSOLE_CMD'][] = 'ContaoDoctrineCache\\Command\\ClearDoctrineCache';

$GLOBALS['TL_PURGE']['custom']['contao-doctrine-cache']['callback'] =
    array('ContaoDoctrineCache\Backend\ClearDoctrineCache', 'flush');
