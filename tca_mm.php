<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

#$EXTCONF = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['hisodat']);	// unserializing the configuration so we can use it here


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
				'wizards' => Array(
					'edit' => Array(
						'type' => 'popup',
						'title' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_pers.uid_src.wizard_edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'JSopenParams' => 'height=500,width=680,status=0,menubar=0,scrollbars=1',
					),
				),
			)
		),
		'uid_pers' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_pers.uid_pers',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_pers.uid_pers.I.0',0),
				),
				'foreign_table' => 'tx_hisodat_persons',
				'foreign_table_where' => 'AND tx_hisodat_persons.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_persons.name',
				'size' => 1,
				'maxitems' => 1,
				'wizards' => Array(
					'_PADDING' => 2,
					'_VERTICAL' => 1,
					'add' => Array(
						'type' => 'script',
						'notNewRecords' => 1,
						'title' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_pers.uid_pers.wizard_add',
						'icon' => 'add.gif',
						'params' => Array(
							'table'=>'tx_hisodat_persons',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
					'edit' => Array(
						'type' => 'popup',
						'title' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_pers.uid_pers.wizard_edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'JSopenParams' => 'height=500,width=680,status=0,menubar=0,scrollbars=1',
					),			
				),
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
		'0' => Array('showitem' => 'hidden,uid_src,uid_pers,issuer,receiver,description')
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
				'wizards' => Array(
					'edit' => Array(
						'type' => 'popup',
						'title' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_loc.uid_src.wizard_edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'JSopenParams' => 'height=500,width=680,status=0,menubar=0,scrollbars=1',
					),
				),		
			)
		),
		'uid_loc' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_loc.uid_loc',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_loc.uid_loc.I.0',0),
				),
				'foreign_table' => 'tx_hisodat_localities',
				'foreign_table_where' => 'AND tx_hisodat_localities.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_localities.title',
				'size' => 1,
				'maxitems' => 1,
				'wizards' => Array(
					'_PADDING' => 2,
					'_VERTICAL' => 1,
					'add' => Array(
						'type' => 'script',
						'notNewRecords' => 1,
						'title' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_loc.uid_loc.wizard_add',
						'icon' => 'add.gif',
						'params' => Array(
							'table'=>'tx_hisodat_localities',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
					'edit' => Array(
						'type' => 'popup',
						'title' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_loc.uid_loc.wizard_edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'JSopenParams' => 'height=500,width=680,status=0,menubar=0,scrollbars=1',
					),
				),
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
		'showRecordFieldList' => 'hidden,uid_src,uid_ent,uid_loc,issuer,receiver,description'
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
				'wizards' => Array(
					'edit' => Array(
						'type' => 'popup',
						'title' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_ent.uid_src.wizard_edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'JSopenParams' => 'height=500,width=680,status=0,menubar=0,scrollbars=1',
					),
				),		
			)
		),
		'uid_ent' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_ent.uid_ent',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_ent.uid_ent.I.0',0),
				),
				'foreign_table' => 'tx_hisodat_entities',
				'foreign_table_where' => 'AND tx_hisodat_entities.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_entities.title',
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required',
				'wizards' => Array(
					'_PADDING' => 2,
					'_VERTICAL' => 1,
					'add' => Array(
						'type' => 'script',
						'notNewRecords' => 1,
						'title' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_ent.uid_ent.wizard_add',
						'icon' => 'add.gif',
						'params' => Array(
							'table'=>'tx_hisodat_entities',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
					'edit' => Array(
						'type' => 'popup',
						'title' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_ent.uid_ent.wizard_edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'JSopenParams' => 'height=500,width=680,status=0,menubar=0,scrollbars=1',
					),
				),
			)
		),			
		'uid_loc' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_ent.uid_loc',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:hisodat/lang/locallang_db.xml:tx_hisodat_mm_src_ent.uid_loc.I.0',0),
				),
				'foreign_table' => 'tx_hisodat_localities',
				'foreign_table_where' => 'AND tx_hisodat_localities.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_localities.title',
				'size' => 1,
				'maxitems' => 1,			
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
		'0' => Array('showitem' => 'hidden,uid_src,uid_ent,uid_loc,issuer,receiver,description')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);
?>