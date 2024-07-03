<?php

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['verkehrsmeldungen_list']   = '{title_legend},name,headline,type;{config_legend},fahrtausfaelle_readerModule;{redirect_legend},jumpTo;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['verkehrsmeldungen_detail'] = '{title_legend},name,headline,type;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['verkehrsmeldungen_page']   = '{title_legend},name,headline,type;{config_legend},faq_categories;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * Add fields to tl_module
 */

$GLOBALS['TL_DCA']['tl_module']['fields']['fahrtausfaelle_readerModule'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['fahrtausfaelle_readerModule'],
	'exclude'                 => true,
	'inputType'               => 'select',
	//'options_callback'        => array('tl_module_fahrtausfaelle', 'getReaderModules'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_module'],
	'eval'                    => array('includeBlankOption'=>true),
    'sql'                     => "int(10) unsigned NOT NULL default '0'"
);

