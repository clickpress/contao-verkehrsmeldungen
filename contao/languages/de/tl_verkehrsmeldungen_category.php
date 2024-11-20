<?php

/**
 * This file is part of the Fahrtausfaelle Bundle.
 *
 * (c) CLICKPRESS <https://clickpress.de>
 *
 * @package   fahrtausfaelle
 * @author    Stefan Schulz-Lauterbach <https://github.com/stefansl>
 * @license   MIT
 * @copyright clickpress.de 2024
 */

namespace Revg;


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['linie']          = ['Linie', 'Bitte geben Sie die Nummer der Bus-Linie ein.'];
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['rvk']          = ['RVK-Linie', 'Bei einer RVK-Linie wird ein alternativer Text bei nicht vorhandenen Meldungen erscheinen.'];
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['headline']       = ['Überschrift', 'Bitte geben Sie die Kategorie-Überschrift ein.'];
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['sortOrder']      = ['Sortierung', 'Standardmäßig werden Kommentare aufsteigend sortiert, beginnend mit dem ältesten.'];
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['tstamp']         = ['Änderungsdatum', 'Datum und Uhrzeit der letzten Änderung'];
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['addEnclosure'] = ['Minifahrplan hinzufügen', 'Der Linie einen Minifahrplan als Download hinzufügen.'];
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['enclosure']    = ['Minifahrplan', 'Bitte wählen Sie den Minfahrplan aus, den Sie hinzufügen möchten.'];
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['published']    = ['Linien-Kategorie veröffentlichen', 'Die Linien-Kategorie auf der Webseite anzeigen.'];

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['linie_legend'] = 'Linie';
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['publish_legend']  = 'Veröffentlichung';
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['enclosure_legend'] = 'Minifahrplan';

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['notify_admin']  = 'Systemadministrator';
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['notify_author'] = 'Autor der Frage';
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['notify_both']   = 'Autor und Systemadministrator';
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['deleteConfirm'] = 'Wenn Sie die Kategorie %s löschen, werden auch alle darin enthaltenen Fahrtausfälle gelöscht! Fortfahren?';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['new']        = ['Neue Linie', 'Eine neue Linie anlegen'];
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['show']       = ['Liniedetails', 'Details der Linie ID %s anzeigen'];
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['edit']       = ['Linie bearbeiten', 'Linie ID %s bearbeiten'];
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['editheader'] = ['Linie-Einstellungen bearbeiten', 'Einstellungen der Linie ID %s bearbeiten'];
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['copy']       = ['Linie duplizieren', 'Linie ID %s duplizieren'];
$GLOBALS['TL_LANG']['tl_verkehrsmeldungen_category']['delete']     = ['Linie löschen', 'Linie ID %s löschen'];
