<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

#$EXTCONF = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['hisodat']);	// unserializing the configuration so we can use it here

$TCA['tx_hisodat_mm_src_key'] = Array (
	'ctrl' => $TCA['tx_hisodat_mm_src_key']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,uid_src,uid_key'
	),
	'feInterface' => $TCA['tx_hisodat_mm_src_key']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'uid_src' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_key.uid_src',
			'config' => Array (
				'type' => 'select',
				'foreign_table' => 'tx_hisodat_sources',
				# REMEMBER: This TSConfig marker has to be set for the parent table to be filled in the context of the inline MM table here (TCEFORM.tx_hisodat_sources.keywords_uids)
				'foreign_table_where' => 'AND tx_hisodat_sources.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_sources.signature',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'uid_key' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_key.uid_key',
			'config' => Array (
				'type' => 'select',
				'foreign_table' => 'tx_hisodat_keywords',
				'foreign_table_where' => 'AND tx_hisodat_keywords.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_keywords.title',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'keysort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'srcsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,uid_src,uid_key')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);


$TCA['tx_hisodat_mm_src_pers'] = Array (
	'ctrl' => $TCA['tx_hisodat_mm_src_pers']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,uid_src,uid_pers,issuer,receiver,description,parenttable'
	),
	'feInterface' => $TCA['tx_hisodat_mm_src_pers']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'uid_src' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_pers.uid_src',
			'config' => Array (
				'type' => 'select',
				'foreign_table' => 'tx_hisodat_sources',
				'foreign_table_where' => 'AND tx_hisodat_sources.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_sources.signature',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'uid_pers' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_pers.uid_pers',
			'config' => Array (
				'type' => 'select',
/*				'items' => Array (
					Array('',0),
				),*/
				'foreign_table' => 'tx_hisodat_persons',
				'foreign_table_where' => 'AND tx_hisodat_persons.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_persons.name',
				'size' => 1,
				'maxitems' => 1,
/*				'wizards' => Array(
					'_PADDING' => 2,
					'_VERTICAL' => 1,
					'add' => Array(
						'type' => 'script',
						'notNewRecords' => 1,
						'title' => 'Neue Person anlegen',
						'icon' => 'add.gif',
						'params' => Array(
							'table'=>'tx_hisodat_persons',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
				),*/
			)
		),
		'issuer' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_pers.issuer',
			'config' => Array (
				'type' => 'check',
				'default' => '0',
			)
		),
		'receiver' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_pers.receiver',
			'config' => Array (
				'type' => 'check',
				'default' => '0',
			)
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_mm_src_pers.description',
			'config' => Array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'parenttable' => Array (
			'config' => Array (
				'type' => 'none',
			)
		),
		'perssort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,uid_src,uid_pers,issuer,receiver,description,parenttable')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);


$TCA['tx_hisodat_mm_src_loc'] = Array (
	'ctrl' => $TCA['tx_hisodat_mm_src_loc']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,uid_src,uid_loc,issuer,receiver,description'
	),
	'feInterface' => $TCA['tx_hisodat_mm_src_loc']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'uid_src' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_loc.uid_src',
			'config' => Array (
				'type' => 'select',
				'foreign_table' => 'tx_hisodat_sources',
				'foreign_table_where' => 'AND tx_hisodat_sources.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_sources.signature',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'uid_loc' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_loc.uid_loc',
			'config' => Array (
				'type' => 'select',
/*
				'items' => Array (
					Array('',0),
				),
*/
				'foreign_table' => 'tx_hisodat_localities',
				'foreign_table_where' => 'AND tx_hisodat_localities.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_localities.title',
				'size' => 1,
				'maxitems' => 1,
/*
				'wizards' => Array(
					'_PADDING' => 2,
					'_VERTICAL' => 1,
					'add' => Array(
						'type' => 'script',
						'notNewRecords' => 1,
						'title' => 'Neue Lokalität anlegen',
						'icon' => 'add.gif',
						'params' => Array(
							'table'=>'tx_hisodat_localities',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
				),
*/
			)
		),
		'issuer' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_loc.issuer',
			'config' => Array (
				'type' => 'check',
				'default' => '0',
			)
		),
		'receiver' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_loc.receiver',
			'config' => Array (
				'type' => 'check',
				'default' => '0',
			)
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_mm_src_loc.description',
			'config' => Array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'parenttable' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'locsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,uid_src,uid_loc,issuer,receiver,description')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);


$TCA['tx_hisodat_mm_src_ent'] = Array (
	'ctrl' => $TCA['tx_hisodat_mm_src_ent']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,uid_src,uid_ent,issuer,receiver,description'
	),
	'feInterface' => $TCA['tx_hisodat_mm_src_ent']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'uid_src' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_ent.uid_src',
			'config' => Array (
				'type' => 'select',
				'foreign_table' => 'tx_hisodat_sources',
				'foreign_table_where' => 'AND tx_hisodat_sources.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_sources.signature',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'uid_ent' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_ent.uid_ent',
			'config' => Array (
				'type' => 'select',
/*				'items' => Array (
					Array('',0),
				),*/
				'foreign_table' => 'tx_hisodat_entities',
				'foreign_table_where' => 'AND tx_hisodat_entities.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_entities.title',
				'size' => 1,
				'maxitems' => 1,
/*				'wizards' => Array(
					'_PADDING' => 2,
					'_VERTICAL' => 1,
					'add' => Array(
						'type' => 'script',
						'notNewRecords' => 1,
						'title' => 'Neue Entität anlegen',
						'icon' => 'add.gif',
						'params' => Array(
							'table'=>'tx_hisodat_entities',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
				),*/
			)
		),
		'issuer' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_ent.issuer',
			'config' => Array (
				'type' => 'check',
				'default' => '0',
			)
		),
		'receiver' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_ent.receiver',
			'config' => Array (
				'type' => 'check',
				'default' => '0',
			)
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_mm_src_ent.description',
			'config' => Array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'parenttable' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'entsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,uid_src,uid_ent,issuer,receiver,description')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);


$TCA['tx_hisodat_mm_lit'] = Array (
	'ctrl' => $TCA['tx_hisodat_mm_lit']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,uid_local,uid_foreign,notation'
	),
	'feInterface' => $TCA['tx_hisodat_mm_lit']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		// this field stores the uids from sources, persons, entities and localities
		'uid_local' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_lit.uid_local',
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'uid_foreign' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_lit.uid_foreign',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('',0),
				),
				'foreign_table' => 'tx_hisodat_literature',
				'foreign_table_where' => 'AND tx_hisodat_literature.pid IN (7) ORDER BY tx_hisodat_literature.short',
				'size' => 1,
				'maxitems' => 1,
				'wizards' => Array(
					'_PADDING' => 2,
					'_VERTICAL' => 1,
					'add' => Array(
						'type' => 'script',
						'notNewRecords' => 1,
						'title' => 'Neue Literatur anlegen',
						'icon' => 'add.gif',
						'params' => Array(
							'table'=>'tx_hisodat_literature',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
				),
			)
		),
		'notation' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_lit.notation',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		// this field stores the tablenames to keep the records distinct
		'parenttable' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'litsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,uid_local,uid_foreign,notation')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);

/*
$TCA['tx_hisodat_mm_pers_pers'] = Array (
	'ctrl' => $TCA['tx_hisodat_mm_pers_pers']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,uid_local,uid_foreign,relations_uids,description'
	),
	'feInterface' => $TCA['tx_hisodat_mm_pers_pers']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'uid_local' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_pers_pers.uid_local',
			'config' => Array (
				'type' => 'select',
				'items' => Array(
					Array('',0),
				),
				'foreign_table' => 'tx_hisodat_persons',
				'foreign_table_where' => 'AND tx_hisodat_persons.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_persons.lastname',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'uid_foreign' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_pers_pers.uid_foreign',
			'config' => Array (
				'type' => 'select',
				'items' => Array(
					Array('',0),
				),
				'foreign_table' => 'tx_hisodat_persons',
				'foreign_table_where' => 'AND tx_hisodat_persons.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_persons.lastname',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'relations_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_pers_pers.relations_uids',
			'config' => Array (
				'type' => 'select',
				'form_type' => 'user',
				'userFunc' => 'tx_hisodat_treeview->displayCategoryTree',
				'treeView' => 1,
				'size' => 5,
				'autoSizeMax' => 15,
				'minitems' => 0,
				'maxitems' => 20,
				'foreign_table' => 'tx_hisodat_relations',
				'foreign_table_where' => 'AND tx_hisodat_relations.pid IN (###PAGE_TSCONFIG_IDLIST###) AND tx_hisodat_relations.relationtype = 1',
			),
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_mm_pers_pers.description',
			'config' => Array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'parenttable' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'foreignsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'localsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,uid_local,uid_foreign,relations_uids,description')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);


$TCA['tx_hisodat_mm_pers_loc'] = Array (
	'ctrl' => $TCA['tx_hisodat_mm_pers_loc']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,uid_pers,uid_loc,relations_uids,description'
	),
	'feInterface' => $TCA['tx_hisodat_mm_pers_loc']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'uid_pers' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_pers_loc.uid_pers',
			'config' => Array (
				'type' => 'select',
				'items' => Array(
					Array('',0),
				),
				'foreign_table' => 'tx_hisodat_persons',
				'foreign_table_where' => 'AND tx_hisodat_persons.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_persons.lastname',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'uid_loc' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_pers_loc.uid_loc',
			'config' => Array (
				'type' => 'select',
				'items' => Array(
					Array('',0),
				),
				'foreign_table' => 'tx_hisodat_localities',
				'foreign_table_where' => 'AND tx_hisodat_localities.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_localities.title',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'relations_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_pers_loc.relations_uids',
			'config' => Array (
				'type' => 'select',
				'form_type' => 'user',
				'userFunc' => 'tx_hisodat_treeview->displayCategoryTree',
				'treeView' => 1,
				'size' => 5,
				'autoSizeMax' => 15,
				'minitems' => 0,
				'maxitems' => 20,
				'foreign_table' => 'tx_hisodat_relations',
				'foreign_table_where' => 'AND tx_hisodat_relations.pid IN (###PAGE_TSCONFIG_IDLIST###) AND tx_hisodat_relations.relationtype = 2',
			),
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_mm_pers_loc.description',
			'config' => Array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'parenttable' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'foreignsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'localsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,uid_pers,uid_loc,relations_uids,description')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);


$TCA['tx_hisodat_mm_loc_loc'] = Array (
	'ctrl' => $TCA['tx_hisodat_mm_loc_loc']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,uid_local,uid_foreign,relations_uids,description'
	),
	'feInterface' => $TCA['tx_hisodat_ff_attr_pers_pers']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'uid_local' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_loc_loc.uid_local',
			'config' => Array (
				'type' => 'select',
				'items' => Array(
					Array('',0),
				),
				'foreign_table' => 'tx_hisodat_localities',
				'foreign_table_where' => 'AND tx_hisodat_localities.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_localities.title',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'uid_foreign' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_loc_loc.uid_foreign',
			'config' => Array (
				'type' => 'select',
				'items' => Array(
					Array('',0),
				),
				'foreign_table' => 'tx_hisodat_localities',
				'foreign_table_where' => 'AND tx_hisodat_localities.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_localities.title',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'relations_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_loc_loc.relations_uids',
			'config' => Array (
				'type' => 'select',
				'form_type' => 'user',
				'userFunc' => 'tx_hisodat_treeview->displayCategoryTree',
				'treeView' => 1,
				'size' => 5,
				'autoSizeMax' => 15,
				'minitems' => 0,
				'maxitems' => 20,
				'foreign_table' => 'tx_hisodat_relations',
				'foreign_table_where' => 'AND tx_hisodat_relations.pid IN (###PAGE_TSCONFIG_IDLIST###) AND tx_hisodat_relations.relationtype = 3',
			),
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_mm_loc_loc.description',
			'config' => Array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'parenttable' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'foreignsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'localsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,uid_local,uid_foreign,relations_uids,description')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);


$TCA['tx_hisodat_mm_ent_loc'] = Array (
	'ctrl' => $TCA['tx_hisodat_mm_ent_loc']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,uid_ent,uid_loc,relations_uids,description'
	),
	'feInterface' => $TCA['tx_hisodat_mm_ent_loc']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'uid_ent' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_ent_loc.uid_ent',
			'config' => Array (
				'type' => 'select',
				'items' => Array(
					Array('',0),
				),
				'foreign_table' => 'tx_hisodat_entities',
				'foreign_table_where' => 'AND tx_hisodat_entities.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_entities.title',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'uid_loc' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_ent_loc.uid_loc',
			'config' => Array (
				'type' => 'select',
				'items' => Array(
					Array('',0),
				),
				'foreign_table' => 'tx_hisodat_localities',
				'foreign_table_where' => 'AND tx_hisodat_localities.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_localities.title',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'relations_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_ent_loc.relations_uids',
			'config' => Array (
				'type' => 'select',
				'form_type' => 'user',
				'userFunc' => 'tx_hisodat_treeview->displayCategoryTree',
				'treeView' => 1,
				'size' => 5,
				'autoSizeMax' => 15,
				'minitems' => 0,
				'maxitems' => 20,
				'foreign_table' => 'tx_hisodat_relations',
				'foreign_table_where' => 'AND tx_hisodat_relations.pid IN (###PAGE_TSCONFIG_IDLIST###) AND tx_hisodat_relations.relationtype = 5',
			),
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_mm_ent_loc.description',
			'config' => Array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'parenttable' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'foreignsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'localsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,uid_ent,uid_loc,relations_uids,description')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);


$TCA['tx_hisodat_mm_ent_pers'] = Array (
	'ctrl' => $TCA['tx_hisodat_mm_ent_pers']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,uid_ent,uid_pers,relations_uids,description'
	),
	'feInterface' => $TCA['tx_hisodat_mm_ent_pers']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'uid_ent' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_ent_pers.uid_ent',
			'config' => Array (
				'type' => 'select',
				'items' => Array(
					Array('',0),
				),
				'foreign_table' => 'tx_hisodat_entities',
				'foreign_table_where' => 'AND tx_hisodat_entities.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_entities.title',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'uid_pers' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_ent_pers.uid_pers',
			'config' => Array (
				'type' => 'select',
				'items' => Array(
					Array('',0),
				),
				'foreign_table' => 'tx_hisodat_persons',
				'foreign_table_where' => 'AND tx_hisodat_persons.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_persons.lastname',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'relations_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_ent_pers.relations_uids',
			'config' => Array (
				'type' => 'select',
				'form_type' => 'user',
				'userFunc' => 'tx_hisodat_treeview->displayCategoryTree',
				'treeView' => 1,
				'size' => 5,
				'autoSizeMax' => 15,
				'minitems' => 0,
				'maxitems' => 20,
				'foreign_table' => 'tx_hisodat_relations',
				'foreign_table_where' => 'AND tx_hisodat_relations.pid IN (###PAGE_TSCONFIG_IDLIST###) AND tx_hisodat_relations.relationtype = 4',
			),
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_mm_ent_pers.description',
			'config' => Array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'parenttable' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'foreignsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'localsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,uid_ent,uid_pers,relations_uids,description')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);


$TCA['tx_hisodat_mm_ent_ent'] = Array (
	'ctrl' => $TCA['tx_hisodat_mm_ent_ent']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,uid_local,uid_foreign,relations_uids,description'
	),
	'feInterface' => $TCA['tx_hisodat_mm_ent_ent']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'uid_local' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_ent_ent.uid_local',
			'config' => Array (
				'type' => 'select',
				'items' => Array(
					Array('',0),
				),
				'foreign_table' => 'tx_hisodat_entities',
				'foreign_table_where' => 'AND tx_hisodat_entities.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_entities.title',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'uid_foreign' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_ent_ent.uid_foreign',
			'config' => Array (
				'type' => 'select',
				'items' => Array(
					Array('',0),
				),
				'foreign_table' => 'tx_hisodat_entities',
				'foreign_table_where' => 'AND tx_hisodat_entities.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_entities.title',
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'relations_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_ent_ent.relations_uids',
			'config' => Array (
				'type' => 'select',
				'form_type' => 'user',
				'userFunc' => 'tx_hisodat_treeview->displayCategoryTree',
				'treeView' => 1,
				'size' => 5,
				'autoSizeMax' => 15,
				'minitems' => 0,
				'maxitems' => 20,
				'foreign_table' => 'tx_hisodat_relations',
				'foreign_table_where' => 'AND tx_hisodat_relations.pid IN (###PAGE_TSCONFIG_IDLIST###) AND tx_hisodat_relations.relationtype = 6',
			),
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_mm_ent_ent.description',
			'config' => Array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'parenttable' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'foreignsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
		'localsort' => Array (
			'config' => Array (
				'type' => 'passthrough',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,uid_local,uid_foreign,relations_uids,description')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);
*/
?>