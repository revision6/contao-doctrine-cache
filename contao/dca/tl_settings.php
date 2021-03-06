<?php

// Palettes
$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'doctrineCacheEnabled';

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .=
    ';{doctrinecache_legend},doctrineCacheEnabled';

$GLOBALS['TL_DCA']['tl_settings']['subpalettes']['doctrineCacheEnabled'] =
    'doctrineCacheTtl,doctrineCacheDisableParam';

// Fields
$GLOBALS['TL_DCA']['tl_settings']['fields']['doctrineCacheEnabled'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['doctrineCacheEnabled'],
    'inputType' => 'checkbox',
    'eval'      => array(
        'submitOnChange' => true
    ),
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['doctrineCacheTtl'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['doctrineCacheTtl'],
    'inputType' => 'text',
    'eval'      => array(
        'rgxp'     => 'digit',
        'tl_class' => 'clr w50',
    ),
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['doctrineCacheDisableParam'] = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_settings']['doctrineCacheDisableParam'],
    'inputType' => 'text',
    'eval'      => array(
        'tl_class' => 'w50',
    ),
);
