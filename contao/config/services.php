<?php

global $container;

$container['doctrine-cache'] = $container->share(
    function () {
        if (!Config::get('doctrineCacheEnabled')) {
            $cache = new \Doctrine\Common\Cache\ArrayCache();

        } else {
            $cache = new \Doctrine\Common\Cache\ApcCache();
        }

        return $cache;
    }
);