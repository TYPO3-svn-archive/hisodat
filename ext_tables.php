<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

// GENERAL CONFIGURATION
t3lib_div::loadTCA('tt_content');

// FLEXFORMS
$TCA['tt_content']['types']['list']['subtypes_excludelist']['tx_hisodat']='layout,select_key,pages,recursive';
$TCA['tt_content']['types']['list']['subtypes_addlist']['tx_hisodat']='pi_flexform';

t3lib_extMgm::addPiFlexFormValue('tx_hisodat', 'FILE:EXT:hisodat/configuration/flexform.xml');
t3lib_extMgm::addPlugin(array('HISODAT', 'tx_hisodat'));

// TYPOSCRIPT
t3lib_extMgm::addStaticFile($_EXTKEY, './configuration', 'HISODAT: Base');

// BACKEND RELATED
if (TYPO3_MODE=='BE') {

	// wizard icon
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_hisodat_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'configuration/class.tx_hisodat_wizicon.php';

	// include hook class
	include_once(t3lib_extMgm::extPath($_EXTKEY).'configuration/class.tx_hisodat_t3lib_tceforms.php');

	// register hook for tceforms
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tceforms.php']['getSingleFieldClass'][] = 'EXT:hisodat/configuration/class.tx_hisodat_t3lib_tceforms.php:tx_hisodat_t3lib_tceforms';

}

// TABLE CONFIGURATION
// archive table: each source belongs to a certain archive
t3lib_extMgm::allowTableOnStandardPages('tx_hisodat_archives');
t3lib_extMgm::addLLrefForTCAdescr('tx_hisodat_archives','EXT:hisodat/lang/locallang_csh_archives.php');
$TCA['tx_hisodat_archives'] = Array (
	'ctrl' => Array (
		'title' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_archives',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY title',
		'delete' => 'deleted',
		'enablecolumns' => Array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca_main.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_hisodat_archives.gif',
	),
);

// persons table: source records can have persons attached
t3lib_extMgm::allowTableOnStandardPages('tx_hisodat_persons');
t3lib_extMgm::addLLrefForTCAdescr('tx_hisodat_persons','EXT:hisodat/lang/locallang_csh_persons.php');
$TCA['tx_hisodat_persons'] = Array (
	'ctrl' => Array (
		'title' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY name',
		'delete' => 'deleted',
		'enablecolumns' => Array (
			'disabled' => 'hidden',
		),
		'dividers2tabs' => '1',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca_main.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_hisodat_persons.gif',
	),
);

// localities table: each source can have localities attached that appear in the source (court, abbey, village etc.);
// the localities will later be appended with GEO data
t3lib_extMgm::allowTableOnStandardPages('tx_hisodat_localities');
t3lib_extMgm::addLLrefForTCAdescr('tx_hisodat_localities','EXT:hisodat/lang/locallang_csh_localities.php');
$TCA['tx_hisodat_localities'] = Array (
	'ctrl' => Array (
		'title' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY title',
		'delete' => 'deleted',
		'enablecolumns' => Array (
			'disabled' => 'hidden',
		),
		'dividers2tabs' => '1',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca_main.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_hisodat_localities.gif',
	),
);

// entities table
t3lib_extMgm::allowTableOnStandardPages('tx_hisodat_entities');
t3lib_extMgm::addLLrefForTCAdescr('tx_hisodat_entities','EXT:hisodat/lang/locallang_csh_entities.php');
$TCA['tx_hisodat_entities'] = Array (
	'ctrl' => Array (
		'title' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY title',
		'delete' => 'deleted',
		'enablecolumns' => Array (
			'disabled' => 'hidden',
		),
		'dividers2tabs' => '1',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca_main.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_hisodat_entities.gif',
	),
);

// sources table: the hisodat source records
t3lib_extMgm::allowTableOnStandardPages('tx_hisodat_sources');
t3lib_extMgm::addLLrefForTCAdescr('tx_hisodat_sources','EXT:hisodat/lang/locallang_csh_sources.php');
$TCA['tx_hisodat_sources'] = Array (
	'ctrl' => Array (
		'title' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources',
		'label' => 'signature',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY signature',
		'delete' => 'deleted',
		'dividers2tabs' => '1',
		'enablecolumns' => Array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca_main.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_hisodat_sources.gif',
	),
);



### MM TABLES ###

t3lib_extMgm::allowTableOnStandardPages('tx_hisodat_mm_src_src');
#t3lib_extMgm::addLLrefForTCAdescr('tx_hisodat_mm_src_pers','EXT:hisodat/lang/locallang_csh_src_pers_loc.php');
$TCA['tx_hisodat_mm_src_src'] = Array (
	'ctrl' => Array (
		'title' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_mm_src_src',
		'label' => 'uid_local',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => Array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca_mm.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_hisodat_records.gif',
	),
);

t3lib_extMgm::allowTableOnStandardPages('tx_hisodat_mm_src_pers');
#t3lib_extMgm::addLLrefForTCAdescr('tx_hisodat_mm_src_pers','EXT:hisodat/lang/locallang_csh_src_pers_loc.php');
$TCA['tx_hisodat_mm_src_pers'] = Array (
	'ctrl' => Array (
		'title' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_mm_src_pers',
		'label' => 'uid_src',
		'label_alt' => ',uid_pers',
		'label_alt_force' => 1,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => Array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca_mm.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_hisodat_records.gif',
	),
);

t3lib_extMgm::allowTableOnStandardPages('tx_hisodat_mm_src_loc');
#t3lib_extMgm::addLLrefForTCAdescr('tx_hisodat_mm_src_loc','EXT:hisodat/lang/locallang_csh_mm_src_pers_loc.php');
$TCA['tx_hisodat_mm_src_loc'] = Array (
	'ctrl' => Array (
		'title' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_mm_src_loc',
		'label' => 'uid_src',
		'label_alt' => ',uid_loc',
		'label_alt_force' => 1,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => Array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca_mm.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_hisodat_records.gif',
	),
);

t3lib_extMgm::allowTableOnStandardPages('tx_hisodat_mm_src_ent');
#t3lib_extMgm::addLLrefForTCAdescr('tx_hisodat_mm_src_loc','EXT:hisodat/lang/locallang_csh_mm_src_pers_loc.php');
$TCA['tx_hisodat_mm_src_ent'] = Array (
	'ctrl' => Array (
		'title' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_mm_src_ent',
		'label' => 'uid_src',
		'label_alt' => ',uid_ent',
		'label_alt_force' => 1,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => Array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca_mm.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_hisodat_records.gif',
	),
);
?>