<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

// MVC class & autoloader
require_once (t3lib_extMgm::extPath('div') . 'class.tx_div.php');
if (TYPO3_MODE == 'FE') tx_div::autoLoadAll($_EXTKEY);

// unserializing the configuration so we can use it here
$EXTCONF = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['hisodat']);

// set the pid lists for the foreign_where clauses
t3lib_extMgm::addPageTSConfig('
	tx_hisodat.ARCHIVES_PIDLIST = '.$EXTCONF['ARCHIVES_PIDLIST'].'
	tx_hisodat.PERSONS_PIDLIST = '.$EXTCONF['PERSONS_PIDLIST'].'
	tx_hisodat.LOCALITIES_PIDLIST = '.$EXTCONF['LOCALITIES_PIDLIST'].'
	tx_hisodat.SOURCES_PIDLIST = '.$EXTCONF['SOURCES_PIDLIST'].'
	tx_hisodat.ENTITIES_PIDLIST = '.$EXTCONF['ENTITIES_PIDLIST'].'
	tx_hisodat.MM_PID = '.$EXTCONF['MM_PID'].'
	<INCLUDE_TYPOSCRIPT: source="FILE:EXT:hisodat/configuration/pagetsconfig.txt">
');
?>