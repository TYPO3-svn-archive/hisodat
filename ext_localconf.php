<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

// MVC class & autoloader
require_once (t3lib_extMgm::extPath('div') . 'class.tx_div.php');
if (TYPO3_MODE == 'FE') tx_div::autoLoadAll($_EXTKEY);

// unserializing the configuration so we can use it here
$EXTCONF = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['hisodat']);

// add a save & new button for all hisodat tables
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_hisodat_archives=1
	options.saveDocNew.tx_hisodat_literature=1
	options.saveDocNew.tx_hisodat_keywords=1
	options.saveDocNew.tx_hisodat_persons=1
	options.saveDocNew.tx_hisodat_localities=1
	options.saveDocNew.tx_hisodat_cat=1
	options.saveDocNew.tx_hisodat_sources=1
	options.saveDocNew.tx_hisodat_relations=1
');

// set the pid lists for the foreign_where clauses
t3lib_extMgm::addPageTSConfig('
	tx_hisodat.ARCHIVES_PIDLIST = '.$EXTCONF['ARCHIVES_PIDLIST'].'
	tx_hisodat.LITERATURE_PIDLIST = '.$EXTCONF['LITERATURE_PIDLIST'].'
	tx_hisodat.KEYWORDS_PIDLIST = '.$EXTCONF['KEYWORDS_PIDLIST'].'
	tx_hisodat.PERSONS_PIDLIST = '.$EXTCONF['PERSONS_PIDLIST'].'
	tx_hisodat.LOCALITIES_PIDLIST = '.$EXTCONF['LOCALITIES_PIDLIST'].'
	tx_hisodat.CATEGORIES_PIDLIST = '.$EXTCONF['CATEGORIES_PIDLIST'].'
	tx_hisodat.SOURCES_PIDLIST = '.$EXTCONF['SOURCES_PIDLIST'].'
	tx_hisodat.RELATIONS_PIDLIST = '.$EXTCONF['RELATIONS_PIDLIST'].'
	tx_hisodat.ENTITIES_PIDLIST = '.$EXTCONF['ENTITIES_PIDLIST'].'
	<INCLUDE_TYPOSCRIPT: source="FILE:EXT:hisodat/configuration/pagetsconfig.txt">
');
?>