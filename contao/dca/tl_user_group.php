<?php

/**
 * This file is part of the Fahrtausfaelle Bundle.
 *
 * (c) CLICKPRESS <https://clickpress.de>
 *
 * @package   fahrtausfaelle
 * @author    Stefan Schulz-Lauterbach <https://github.com/stefansl>
 * @license   MIT
 * @copyright clickpress.de 2018
 */


/**
 * Extend default palette
 */
$GLOBALS['TL_DCA']['tl_user_group']['palettes']['default'] = str_replace('formp;', 'formp;{fahrtausfaelle_legend},fahrtausfaelle,fahrtausfaellep;', $GLOBALS['TL_DCA']['tl_user_group']['palettes']['default']);


/**
 * Add fields to tl_user_group
 */
$GLOBALS['TL_DCA']['tl_user_group']['fields']['fahrtausfaelle'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['fahrtausfaelles'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'foreignKey'              => 'tl_fahrtausfaelle_category.linie',
	'eval'                    => array('multiple'=>true),
    'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_user_group']['fields']['fahrtausfaellep'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['fahrtausfaellep'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'options'                 => array('create', 'delete'),
	'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                    => array('multiple'=>true),
    'sql'                     => "blob NULL"
);
