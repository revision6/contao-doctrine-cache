<?php

global $container;

$container['doctrine-cache'] = $container->share(
    function () {
        $disableCache = false;
        if ($GLOBALS['TL_CONFIG']['doctrineCacheDisableParam']) {
            $disableParams = explode(',', $GLOBALS['TL_CONFIG']['doctrineCacheDisableParam']);

            if (in_array($disableParams, array(array_keys($_GET)))) {
                $disableCache = true;
            }
        }

        if (!Config::get('doctrineCacheEnabled') || $disableCache) {
            $cache = new \Doctrine\Common\Cache\ArrayCache();

        } else {
            $cache = new \Doctrine\Common\Cache\ApcCache();
        }

        return $cache;
    }
);