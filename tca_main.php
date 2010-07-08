<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

#$EXTCONF = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['hisodat']);	// unserializing the configuration so we can use it here

$TCA['tx_hisodat_archives'] = Array (
	'ctrl' => $TCA['tx_hisodat_archives']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,title,description'
	),
	'feInterface' => $TCA['tx_hisodat_archives']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'title' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_archives.title',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'required,trim',
			)
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_archives.description',
			'config' => Array(
				'type' => 'text',
				'cols' => '25',
				'rows' => '5',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,title,description')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);


$TCA['tx_hisodat_persons'] = Array (
	'ctrl' => $TCA['tx_hisodat_persons']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,pnd,gender,name,namevariants,titles,date_comment,date_start,date_end,image,description,persons_uids,entities_uids,localities_uids,source_uids'
	),
	'feInterface' => $TCA['tx_hisodat_persons']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'gender' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.gender',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.gender.I.0', '1'),
					Array('LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.gender.I.1', '2'),
				),
				'eval' => 'required',
				'default' => '1',
			)
		),
		'name' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.name',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'required,trim',
			)
		),
		'namevariants' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.namevariants',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'pnd' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.pnd',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),		
		'titles' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.titles',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'date_comment' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.date_comment',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'date_start' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.date_start',
			'config' => Array (
				'type' => 'input',
				'size' => '10',
				'max' => '10',
				'eval' => 'trim',
			)
		),
		'date_end' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.date_end',
			'config' => Array (
				'type' => 'input',
				'size' => '10',
				'max' => '10',
				'eval' => 'trim',
			)
		),
		'image' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.images',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => '1000',
				'uploadfolder' => 'uploads/pics',
				'show_thumbs' => '1',
				'size' => '3',
				'maxitems' => '10',
				'minitems' => '0'
			)
		),		
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.description',
			'config' => Array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
				'wizards' => Array(
					'_PADDING' => 2,
					'RTE' => Array(
						'notNewRecords' => 1,
						'RTEonly' => 1,
						'type' => 'script',
						'title' => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
						'icon' => 'wizard_rte2.gif',
						'script' => 'wizard_rte.php',
					),
				),
			)
		),
		'source_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.source_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_src_pers',
				'foreign_field' => 'uid_pers',
				'foreign_sortby' => 'perssort',
				'foreign_label' => 'uid_src',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),		
	),
	'types' => Array (
		'0' => Array('showitem' => '
						--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.div1,hidden,pnd,gender,name,namevariants,titles,source_uids,
						--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.div2,date_comment,date_start,date_end,
						--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.div3,description;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/pics/],
						--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.div4,image
		'),
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);


$TCA['tx_hisodat_localities'] = Array (
	'ctrl' => $TCA['tx_hisodat_localities']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,title,namevariants,state,province,district,municipality,latitude,longitude,date_comment,date_start,date_end,image,description,source_uids'
	),
	'feInterface' => $TCA['tx_hisodat_localities']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'title' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.title',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'required,trim',
			)
		),
		'namevariants' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.namevariants',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'state' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.state',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'province' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.province',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'district' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.district',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),						
		'municipality' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.municipality',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'latitude' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.latitude',
			'config' => Array (
				'type' => 'input',
				'size' => '10',
				'max' => '10',
				'eval' => 'trim',
			)
		),
		'longitude' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.longitude',
			'config' => Array (
				'type' => 'input',
				'size' => '10',
				'max' => '10',
				'eval' => 'trim',
			)
		),
		'date_start' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.date_start',
			'config' => Array (
				'type' => 'input',
				'size' => '10',
				'max' => '10',
				'eval' => 'trim',
			)
		),
		'date_end' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.date_end',
			'config' => Array (
				'type' => 'input',
				'size' => '10',
				'max' => '10',
				'eval' => 'trim',
			)
		),
		'date_comment' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.date_comment',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'image' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.images',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => '1000',
				'uploadfolder' => 'uploads/pics',
				'show_thumbs' => '1',
				'size' => '3',
				'maxitems' => '10',
				'minitems' => '0'
			)
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.description',
			'config' => Array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
				'eval' => 'trim',
				'wizards' => Array(
					'_PADDING' => 2,
					'RTE' => Array(
						'notNewRecords' => 1,
						'RTEonly' => 1,
						'type' => 'script',
						'title' => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
						'icon' => 'wizard_rte2.gif',
						'script' => 'wizard_rte.php',
					),
				),
			)
		),
		'source_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.source_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_src_loc',
				'foreign_field' => 'uid_loc',
				'foreign_sortby' => 'locsort',
				'foreign_label' => 'uid_src',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),		
	),
	'types' => Array (
		'0' => Array('showitem' => '
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.div1,hidden,title,namevariants,source_uids,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.div2,state,province,district,municipality,latitude,longitude,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.div3,date_comment,date_start,date_end,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.div4,description;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/pics/],
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.div5,image
		')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);


$TCA['tx_hisodat_entities'] = Array (
	'ctrl' => $TCA['tx_hisodat_entities']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,title,namevariants,date_comment,date_start,date_end,image,description,source_uids'
	),
	'feInterface' => $TCA['tx_hisodat_entities']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'title' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.title',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'required,trim',
			)
		),
		'namevariants' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.namevariants',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'date_comment' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.date_comment',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'date_start' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.date_start',
			'config' => Array (
				'type' => 'input',
				'size' => '10',
				'max' => '10',
				'eval' => 'trim',
			)
		),
		'date_end' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.date_end',
			'config' => Array (
				'type' => 'input',
				'size' => '10',
				'max' => '10',
				'eval' => 'trim',
			)
		),
		'image' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.images',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => '1000',
				'uploadfolder' => 'uploads/pics',
				'show_thumbs' => '1',
				'size' => '3',
				'maxitems' => '10',
				'minitems' => '0'
			)
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.description',
			'config' => Array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
				'wizards' => Array(
					'_PADDING' => 2,
					'RTE' => Array(
						'notNewRecords' => 1,
						'RTEonly' => 1,
						'type' => 'script',
						'title' => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
						'icon' => 'wizard_rte2.gif',
						'script' => 'wizard_rte.php',
					),
				),
			)
		),
		'source_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.source_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_src_ent',
				'foreign_field' => 'uid_ent',
				'foreign_sortby' => 'entsort',
				'foreign_label' => 'uid_src',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),		
	),
	'types' => Array (
		'0' => Array('showitem' => '
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.div1,hidden,title,namevariants,source_uids,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.div2,date_comment,date_start,date_end,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.div3,description;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/pics/],
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.div4,image
		'),
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);

$TCA['tx_hisodat_sources'] = Array (
	'ctrl' => $TCA['tx_hisodat_sources']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,signature,signature_add,urn,archive_uid,date_comment,date_start,date_end,date_sorting,short,sourcetext,description;;;;3-3-3,persons_uids,localities_uids,entities_uids;;;;3-3-3,keywords_uids,literature_uids,sources_uids;;;;3-3-3,image,imagecaption,;;;;3-3-3,editor_id,editor_comment'
	),
	'feInterface' => $TCA['tx_hisodat_sources']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'signature' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.signature',
			'config' => Array (
				'type' => 'input',
				'size' => '40',
				'max' => '255',
				'eval' => 'required,trim',
			)
		),
		'signature_add' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.signature_add',
			'config' => Array (
				'type' => 'input',
				'size' => '40',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'urn' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.urn',
			'config' => Array (
				'type' => 'input',
				'size' => '40',
				'max' => '255',
				'eval' => 'trim',
			)
		),		
		'archive_uid' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.archive_uid',
			'config' => Array (
				'type' => 'select',
				'foreign_table' => 'tx_hisodat_archives',
				'foreign_table_where' => 'AND tx_hisodat_archives.pid IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY tx_hisodat_archives.title',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
				'wizards' => Array(
					'_PADDING' => 2,
					'_VERTICAL' => 1,
					'add' => Array(
						'type' => 'script',
						'title' => 'Neues Archiv anlegen',
						'icon' => 'add.gif',
						'params' => Array(
							'table'=>'tx_hisodat_archives',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'date_start' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.date_start',
			'config' => Array (
				'type' => 'input',
				'size' => '10',
				'max' => '10',
				'eval' => 'trim',
			)
		),
		'date_end' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.date_end',
			'config' => Array (
				'type' => 'input',
				'size' => '10',
				'max' => '10',
				'eval' => 'trim',
			)
		),
		'date_sorting' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.date_sorting',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),		
		'date_comment' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.date_comment',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'short' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.short',
			'config' => Array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '3',
				'eval' => 'trim',
			)
		),
		'sourcetext' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.sourcetext',
			'config' => Array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.description',
			'config' => Array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
				'wizards' => Array(
					'_PADDING' => 2,
					'RTE' => Array(
						'notNewRecords' => 1,
						'RTEonly' => 1,
						'type' => 'script',
						'title' => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
						'icon' => 'wizard_rte2.gif',
						'script' => 'wizard_rte.php',
					),
				),
			)
		),
		'localities_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.localities_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_src_loc',
				'foreign_field' => 'uid_src',	
				'foreign_sortby' => 'locsort',
				'foreign_label' => 'uid_loc',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),
		'entities_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.entities_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_src_ent',
				'foreign_field' => 'uid_src',	
				'foreign_sortby' => 'entsort',
				'foreign_label' => 'uid_ent',		
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),	
		'persons_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.persons_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_src_pers',
				'foreign_field' => 'uid_src',
				'foreign_sortby' => 'perssort',
				'foreign_label' => 'uid_pers',		
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),
		'sources_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.sources_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_src_src',
				'foreign_field' => 'uid_local',
				'foreign_sortby' => 'sorting',
				'foreign_label' => 'uid_foreign',
				'symmetric_field' => 'uid_foreign',
				'symmetric_label' => 'uid_local',
				'symmetric_sortby' => 'sorting',		
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),
		'image' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.images',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => '1000',
				'uploadfolder' => 'uploads/tx_hisodat/',
				'show_thumbs' => '1',
				'size' => '3',
				'maxitems' => '10',
				'minitems' => '0'
			)
		),
		'imagecaption' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.caption',
			'config' => Array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '3'
			)
		),
		'editor_id' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.editor_id',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('',0),
				),
				'foreign_table' => 'be_users',
				'foreign_table_where' => 'AND be_users.usergroup IN (###PAGE_TSCONFIG_IDLIST###) ORDER BY be_users.realName',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'editor_comment' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.editor_comment',
			'config' => Array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => '
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.div1,hidden,signature,signature_add,urn,archive_uid,date_comment,date_start,date_end,date_sorting,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.div2,short,sourcetext,description;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/pics/],
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.div4,persons_uids,localities_uids,entities_uids,sources_uids,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.div5,image,imagecaption,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.div6,editor_id,editor_comment
				')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);
?>