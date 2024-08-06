<?php

use Contao\Versions;
use Contao\DC_Table;
use Contao\BackendUser;
use Contao\DataContainer;

$this->loadLanguageFile('tl_content');

$GLOBALS['TL_DCA']['tl_verkehrsmeldungen_detail'] = array
(

    // Config
    'config' => array
    (
        'dataContainer' => DC_Table::class,
        'ptable' => 'tl_verkehrsmeldungen_category',
        'enableVersioning' => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
                'pid,start,stop,published' => 'index'
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode' => DataContainer::MODE_PARENT,
            'fields' => array('title'),
            'flag' => 12,
            'disableGrouping' => true,
            'panelLayout' => 'filter;sort,search,limit',
            'headerFields' => array('linie', 'addEnclosure', 'published'),
            'child_record_callback' => function (array $row) {
                return '
<div class="cte_type"><strong>' . $row['title'] . '</strong></div>
<div class="limit_height' . (!$GLOBALS['TL_CONFIG']['doNotCollapse'] ? ' h52' : '') . '">
' . $row['entrytext'] . $row['text'] . '
</div>' . "\n";
            },
        ),

        // Not used in sort mode 4!
        'label' => array
        (
            'fields' => array('linie'),
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_detail']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.gif'
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_detail']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if (!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\')) return false; Backend.getScrollOffset();"'
            ),
            'toggle' => array
            (
                'href' => 'act=toggle&amp;field=published',
                'icon' => 'visible.svg',
                'showInHeader' => true
            ),
            'show' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_detail']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif'
            )
        )
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__' => array('addZeit', 'addInfo'),

        'default' => '{verkehrsmeldungen_legend},title,date,entrytext,text;{publish_legend},published,start,stop'
    ),

    // Subpalettes
    'subpalettes' => array
    (
        'addZeit' => 'abfahrtszeit,ankunftszeit',
        'addInfo' => 'ursache,weitereInfos'
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'foreignKey' => 'tl_verkehrsmeldungen_category.linie',
            'sql' => "int(10) unsigned NOT NULL default '0'",
            'relation' => array('type' => 'belongsTo', 'load' => 'lazy')
        ),
        'tstamp' => array
        (
            'default' => time(),
            'inputType' => 'text',
            'eval' => array('rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'),
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'date' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_detail']['tstamp'],
            'default' => time(),
            'sorting' => true,
            'inputType' => 'text',
            'eval' => array('rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'),
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array
        (
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'inputType' => 'text',
            'eval' => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),

        'entrytext' => array
        (
            'exclude' => true,
            'search' => true,
            'inputType' => 'textarea',
            'eval' => array('mandatory' => true, 'rte' => 'tinyMCE', 'helpwizard' => true, 'tl_class' => 'clr'),
            'explanation' => 'insertTags',
            'sql' => "mediumtext NULL"
        ),

        'text' => array
        (
            'exclude' => true,
            'search' => true,
            'inputType' => 'textarea',
            'eval' => array('mandatory' => true, 'rte' => 'tinyMCE', 'helpwizard' => true, 'tl_class' => 'clr'),
            'explanation' => 'insertTags',
            'sql' => "mediumtext NULL"
        ),
        /*
                'addZeit' => array
                (
                    'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_detail']['addZeit'],
                    'default'                 => time(),
                    'exclude'                 => true,
                    'inputType'               => 'checkbox',
                    'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 clr'),
                    'sql'                     => "char(1) NOT NULL default ''"
                ),
                'abfahrtszeit' => array
                (
                    'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_detail']['abfahrtszeit'],
                    'default'                 => time(),
                    'exclude'                 => true,
                    'inputType'               => 'text',
                    'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 clr wizard'),
                    'sql'                     => "int(10) unsigned default '0'",
                ),

                'ankunftszeit' => array
                (
                    'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_detail']['ankunftszeit'],
                    'exclude'                 => true,
                    'inputType'               => 'text',
                    'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
                    'sql'                     => "int(10) unsigned default '0'",
                ),


                'abfahrtsort' => array
                (
                    'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_detail']['abfahrtsort'],
                    'exclude'                 => true,
                    'search'                  => true,
                    'sorting'                 => true,
                    'inputType'               => 'text',
                    'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50 clr'),
                    'sql'                     => "varchar(255) NOT NULL default ''"
                ),
                'ankunftsort' => array
                (
                    'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_detail']['ankunftsort'],
                    'exclude'                 => true,
                    'search'                  => true,
                    'sorting'                 => true,
                    'inputType'               => 'text',
                    'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
                    'sql'                     => "varchar(255) NOT NULL default ''"
                ),
                */
        'alias' => array
        (
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array('rgxp' => 'alnum', 'unique' => true, 'spaceToUnderscore' => true, 'maxlength' => 128, 'tl_class' => 'w50'),
            'sql' => "varchar(255) BINARY NOT NULL default ''"
        ),
        'author' => array
        (
            'default' => BackendUser::getInstance()->id,
            'flag' => 11,
            'inputType' => 'select',
            'foreignKey' => 'tl_user.name',
            'eval' => array('doNotCopy' => true, 'chosen' => true, 'mandatory' => true, 'includeBlankOption' => true, 'tl_class' => 'w50', 'hideInput' => true),
            'sql' => "int(10) unsigned NOT NULL default '0'",
            'relation' => array('type' => 'hasOne', 'load' => 'lazy')
        ),
        /*
        'addInfo' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_detail']['addInfo'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 clr'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'ursache' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_detail']['ursache'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'weitereInfos' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_detail']['weitereInfos'],
            'exclude'                 => true,
            'search'                  => true,
            'sorting'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'icon' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_detail']['icon'],
            'exclude'                 => false,
            'search'                  => false,
            'inputType'               => 'rocksolid_icon_picker',
            'eval'                    => array('iconFont' => 'files/_theme/icons/revg_icons/fonts/revg_icons.svg', 'tl_class'=>'w50 clr'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        */
        'published' => array
        (
            'exclude' => true,
            'filter' => true,
            'flag' => 1,
            'toggle' => true,
            'inputType' => 'checkbox',
            'eval' => array('doNotCopy' => true),
            'sql' => ['type' => 'boolean', 'default' => false],
        ),
        'start' => array
        (
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array('rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'),
            'sql' => "varchar(10) NOT NULL default ''"
        ),
        'stop' => array
        (
            'exclude' => true,
            'inputType' => 'text',
            'eval' => array('rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'),
            'sql' => "varchar(10) NOT NULL default ''"
        )
    )
);
