<?php

/**
 * Extend default palette
 */
$GLOBALS['TL_DCA']['tl_user']['palettes']['extend'] = str_replace('formp;', 'formp;{verkehrsmeldungen_detail_legend},verkehrsmeldungen_detail,verkehrsmeldungen_detailp;', $GLOBALS['TL_DCA']['tl_user']['palettes']['extend']);
$GLOBALS['TL_DCA']['tl_user']['palettes']['custom'] = str_replace('formp;', 'formp;{verkehrsmeldungen_detail_legend},verkehrsmeldungen_detail,verkehrsmeldungen_detailp;', $GLOBALS['TL_DCA']['tl_user']['palettes']['custom']);


/**
 * Add fields to tl_user_group
 */
$GLOBALS['TL_DCA']['tl_user']['fields']['verkehrsmeldungen_detail'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['verkehrsmeldungen_detail'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'foreignKey'              => 'tl_verkehrsmeldungen_category.linie',
	'eval'                    => array('multiple'=>true),
    'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_user']['fields']['fahrtausfaellep'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['verkehrsmeldungen_detailp'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'options'                 => array('create', 'delete'),
	'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                    => array('multiple'=>true),
    'sql'                     => "blob NULL"
);
