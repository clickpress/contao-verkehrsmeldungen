<?php

use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_verkehrsmeldungen_category'] =
    [

	// Config
	'config' =>
        [
		'dataContainer'               => DC_Table::class,
		'ctable'                      => 'tl_verkehrsmeldungen_detail',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
        'sql' =>
            [
            'keys' =>
                [
                'id' => 'primary'
                ]
            ]
		/* 'onload_callback' => array
		(
			array('tl_verkehrsmeldungen_category', 'checkPermission')
		) */
        ],

	// List
	'list' =>
        [
		'sorting' =>
            [
			'mode'                    => 1,
			'fields'                  => ['linie'],
			'flag'                    => 1,
			'panelLayout'             => 'search,limit,filter'
            ],
		'label' =>
            [
			'fields'                  => ['linie'],
			'format'                  => '%s'
            ],
		'global_operations' =>
            [
			'all' =>
                [
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
                ]
            ],
		'operations' =>
            [
			'edit' =>
                [
				'label'               => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['edit'],
				'href'                => 'table=tl_verkehrsmeldungen_detail',
				'icon'                => 'edit.gif',
				'attributes'          => 'class="contextmenu"'
                ],
			'editheader' =>
                [
				'label'               => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'attributes'          => 'class="edit-header"'
                ],
			'copy' =>
                [
				'label'               => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif',
                ],
			'delete' =>
                [
				'label'               => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['delete'],
				'href'                => 'act=delete',
				'icon'                  => 'delete.gif',
                'attributes'                => 'onclick="if (!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\')) return false; Backend.getScrollOffset();"',
                ],
            'toggle' =>
                [
                'label'               => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['toggle'],
                'icon'                => 'visible.gif',
                ],
			'show' =>
                [
				'label'               => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
                ]
            ]
        ],

	// Palettes
	'palettes' =>
        [
		'__selector__'                => ['addEnclosure'],
		'default'                     => '{linie_legend},linie,rvk;{enclosure_legend},addEnclosure;{publish_legend},published'
        ],

	// Subpalettes
	'subpalettes' =>
        [
        'addEnclosure'                => 'enclosure'
        ],

	// Fields
	'fields' =>
        [
        'id' =>
            [
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
            ],
        'tstamp' =>
            [
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
            ],
		'linie' => [
			'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['linie'],
			'exclude'                 => true,
			'search'                  => true,
            'filter'                  => true,
			'inputType'               => 'text',
			'eval'                    => ['mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50', 'unique'=>true],
            'sql'                     => "varchar(255) NOT NULL default ''"
        ],
        'rvk' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['rvk'],
            'default'					=> true,
            'exclude'                 => true,
            'filter'                  => true,
            'flag'                    => 2,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class'=>'w50 cbx m12'],
            'sql'                     => "char(1) NOT NULL default ''"
        ],
/*		'jumpTo' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['jumpTo'],
			'exclude'                 => true,
			'inputType'               => 'pageTree',
			'eval'                    => array('fieldType'=>'radio', 'tl_class'=>'clr')
		),*/
        'addEnclosure' =>
            [
            'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['addEnclosure'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['submitOnChange'=>true],
            'sql'                     => "char(1) NOT NULL default ''"
            ],
        'enclosure' =>
            [
            'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['enclosure'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => ['fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'multiple'=>false, 'mandatory'=>true],
            'sql'                     => "blob NULL"
            ],
		'sortOrder' =>
            [
			'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['sortOrder'],
			'default'                 => 'ascending',
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => ['ascending', 'descending'],
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'eval'                    => ['tl_class'=>'w50'],
            'sql'                     => ['type' => 'string', 'length' => 255, 'default' => '']
            ],
        'published' =>
            [
            'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['published'],
            'default'					=> true,
            'exclude'                 => true,
            'filter'                  => true,
            'flag'                    => 2,
            'toggle' => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['doNotCopy'=>true],
            'sql' => ['type' => 'boolean', 'default' => false],
            ],
        ]
    ];

