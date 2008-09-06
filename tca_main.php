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

/*
$TCA['tx_hisodat_categories'] = Array (
	'ctrl' => $TCA['tx_hisodat_categories']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,title,parent_category,description'
	),
	'feInterface' => $TCA['tx_hisodat_categories']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '1'
			)
		),
		'title' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_categories.title',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'required',
			)
		),
		'parent_category' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_categories.parent_category',
			'config' => Array (
				'type' => 'select',
				'form_type' => 'user',
				'userFunc' => 'tx_hisodat_treeview->displayCategoryTree',
				'treeView' => 1,
				'size' => 1,
				'autoSizeMax' => 10,
				'minitems' => 0,
				'maxitems' => 2,
				'foreign_table' => 'tx_hisodat_categories',
				'foreign_table_where' => 'AND tx_hisodat_categories.pid IN (###PAGE_TSCONFIG_IDLIST###)',
			)
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_categories.description',
			'config' => Array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,title,parent_category,description')
	),
	'palettes' => Array (
		'1' => Array('showitem' => 'fe_group')
	)
);
*/

$TCA['tx_hisodat_keywords'] = Array (
	'ctrl' => $TCA['tx_hisodat_keywords']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,title,description'
	),
	'feInterface' => $TCA['tx_hisodat_keywords']['feInterface'],
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
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_keywords.title',
			'config' => Array (
				'type' => 'input',
				'size' => '40',
				'max' => '255',
				'eval' => 'required,trim',
			)
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_keywords.description',
			'config' => Array(
				'type' => 'text',
				'cols' => '30',
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


$TCA['tx_hisodat_literature'] = Array (
	'ctrl' => $TCA['tx_hisodat_literature']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,title,author,publisher,pub_mag,published,series,short'
	),
	'feInterface' => $TCA['tx_hisodat_literature']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'title' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_literature.title',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'required,trim',
			)
		),
		'author' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_literature.author',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'required,trim',
			)
		),
		'publisher' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_literature.publisher',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'pub_mag' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_literature.pub_mag',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'published' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_literature.published',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'required,trim',
			)
		),
		'series' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_literature.series',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'trim',
			)
		),
		'short' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_literature.short',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'required,trim',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,title,author,publisher,pub_mag,published,series,short')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);


$TCA['tx_hisodat_persons'] = Array (
	'ctrl' => $TCA['tx_hisodat_persons']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,gender,name,namevariants,titles,date_comment,date_start,date_end,image,description,persons_uids,entities_uids,localities_uids,literature_uids'
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
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.lastname',
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
		'persons_uids' => Array (
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.persons_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_pers_pers',
				'foreign_field' => 'uid_local', // stores id of THIS person
				'foreign_table_field' => 'parenttable',
				'foreign_label' => 'uid_foreign',
				'foreign_sortby' => 'foreignsort',
				'symmetric_field' => 'uid_foreign', // stores id of the OTHER person
				'symmetric_label' => 'uid_local',
				'symmetric_sortby' => 'localsort',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
				),
			)
		),
		'entities_uids' => Array (
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.entities_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_ent_pers',
				'foreign_field' => 'uid_pers', // stores id of THIS person
				'foreign_table_field' => 'parenttable',
				'foreign_label' => 'uid_ent',
				'foreign_sortby' => 'perssort',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
				),
			)
		),
		'localities_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.localities_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_pers_loc',
				'foreign_field' => 'uid_pers',
				'foreign_table_field' => 'parenttable',
				'foreign_label' => 'uid_loc',
				'foreign_sortby' => 'locsort',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
				),
			)
		),
		'literature_uids' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.literature_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_lit',
				'foreign_field' => 'uid_local',
				'foreign_table_field' => 'parenttable',
				'foreign_sortby' => 'litsort',
				'foreign_label' => 'uid_foreign',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
				),
			)
		),
	),
	'types' => Array (
#		'0' => Array('showitem' => '
#						--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.div1,hidden,gender,name,namevariants,title,date_comment,date_start,date_end,image,description,
#						--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.div2,persons_uids,localities_uids,entities_uids,literature_uids'
#		),
		'0' => Array('showitem' => '
						--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.div1,hidden,gender,name,namevariants,titles,
						--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.div2,date_comment,date_start,date_end,
						--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_persons.div3,description,literature_uids,
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
		'showRecordFieldList' => 'hidden,title,namevariants,municipality,field_name,latitude,longitude,date_comment,date_start,date_end,image,description,persons_uids,localities_uids,entities_uids,literature_uids'
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
				'eval' => 'trim',
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
		'field_name' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.field_name',
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
			)
		),
		'persons_uids' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.persons_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_pers_loc',
				'foreign_field' => 'uid_loc',
				'foreign_table_field' => 'parenttable',
				'foreign_label' => 'uid_pers',
				'foreign_sortby' => 'perssort',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
				),
			)
		),
		'entities_uids' => Array (
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.entities_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_ent_loc',
				'foreign_field' => 'uid_loc', // stores id of THIS locality
				'foreign_table_field' => 'parenttable',
				'foreign_label' => 'uid_ent',
				'foreign_sortby' => 'locsort',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
				),
			)
		),
		'localities_uids' => Array (
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.localities_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_loc_loc',
				'foreign_field' => 'uid_local', // stores the id of THIS locality
				'foreign_table_field' => 'parenttable',
				'foreign_label' => 'uid_foreign',
				'foreign_sortby' => 'foreignsort',
				'symmetric_field' => 'uid_foreign', // stores the id ot the OTHER locality
				'symmetric_label' => 'uid_local',
				'symmetric_sortby' => 'localsort',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
				),
			)
		),
		'literature_uids' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.literature_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_lit',
				'foreign_field' => 'uid_local',
				'foreign_table_field' => 'parenttable',
				'foreign_sortby' => 'litsort',
				'foreign_label' => 'uid_foreign',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
				),
			)
		),
	),
	'types' => Array (
#		'0' => Array('showitem' => '
#				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.div1,hidden,title,namevariants,municipality,field_name,latitude,longitude,date_comment,date_start,date_end,image,description,
#				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.div2,persons_uids,localities_uids,entities_uids,literature_uids
#				')
		'0' => Array('showitem' => '
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.div1,hidden,title,namevariants,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.div2,municipality,field_name,latitude,longitude,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.div3,date_comment,date_start,date_end,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_localities.div4,description,literature_uids,
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
		'showRecordFieldList' => 'hidden,title,namevariants,date_comment,date_start,date_end,image,description,persons_uids,entities_uids,localities_uids,literature_uids'
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
				'eval' => 'trim',
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
		'entities_uids' => Array (
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.entities_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_ent_ent',
				'foreign_field' => 'uid_local', // stores the id of THIS entity
				'foreign_table_field' => 'parenttable',
				'foreign_label' => 'uid_foreign',
				'foreign_sortby' => 'foreignsort',
				'symmetric_field' => 'uid_foreign', // stores the id ot the OTHER entity
				'symmetric_label' => 'uid_local',
				'symmetric_sortby' => 'localsort',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
				),
			)
		),
		'persons_uids' => Array (
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.persons_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_ent_pers',
				'foreign_field' => 'uid_ent', // stores id of
				'foreign_table_field' => 'parenttable',
				'foreign_label' => 'uid_pers',
				'foreign_sortby' => 'entsort',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
				),
			)
		),
		'localities_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.localities_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_ent_loc',
				'foreign_field' => 'uid_ent',
				'foreign_table_field' => 'parenttable',
				'foreign_label' => 'uid_loc',
				'foreign_sortby' => 'entsort',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
				),
			)
		),
		'literature_uids' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.literature_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_lit',
				'foreign_field' => 'uid_local',
				'foreign_table_field' => 'parenttable',
				'foreign_sortby' => 'litsort',
				'foreign_label' => 'uid_foreign',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
				),
			)
		),
	),
	'types' => Array (
#		'0' => Array('showitem' => '
#				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.div1,hidden,title,namevariants,date_comment,date_start,date_end,image,description,
#				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.div2,persons_uids,localities_uids,entities_uids,literature_uids'),
		'0' => Array('showitem' => '
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.div1,hidden,title,namevariants,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.div2,date_comment,date_start,date_end,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_entities.div3,description,literature_uids,
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
		'showRecordFieldList' => 'hidden,signature,signature_add,archive_uid,date_comment,date_start,date_end,short,sourcetext,description;;;;3-3-3,persons_uids,localities_uids,entities_uids;;;;3-3-3,keywords_uids,literature_uids,sources_uids;;;;3-3-3,image,imagecaption,;;;;3-3-3,editor_id,editor_comment'
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
/*
		'categories_uids' => Array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.categories_uids',
			'config' => Array(
				'type' => 'select',
				'form_type' => 'user',
				'userFunc' => 'tx_hisodat_treeview->displaycategoryTree',
				'treeView' => 1,
				'foreign_table' => 'tx_hisodat_categories',
				'foreign_table_where' => 'AND tx_hisodat_categories.pid IN (###PAGE_TSCONFIG_IDLIST###)',
				'size' => 5,
				'autoSizeMax' => 25,
				'minitems' => 0,
				'maxitems' => 50,
				'MM' => 'tx_hisodat_mm_src_cat',
				'wizards' => Array(
					'_PADDING' => 2,
					'_VERTICAL' => 1,
					'add' => Array(
						'type' => 'script',
						'title' => 'Neue Kategorie anlegen',
						'icon' => 'add.gif',
						'params' => Array(
							'table'=>'tx_hisodat_categories',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
				),
			)
		),
*/
		'keywords_uids' => Array (
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.keywords_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_src_key',
				'foreign_field' => 'uid_src', # write the uid of the source into this field
				'foreign_sortby' => 'keysort', # sorting of keywords within the source record
				'foreign_label' => 'uid_key', # label of the keyword retrieved by it's uid'
				'foreign_selector' => 'uid_key', # choose the existing keywords from - SEE BUG
				'foreign_unique' => 'uid_key', # keywords have to be unique for each source - SEE BUG
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
					'useCombination' => 1,
					'newRecordLinkPosition' => 'bottom',
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
				'foreign_selector' => 'uid_loc',
				'foreign_unique' => 'uid_loc',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
					'useCombination' => 1,
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
				'foreign_selector' => 'uid_ent',
				'foreign_unique' => 'uid_ent',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
					'useCombination' => 1,
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
				'foreign_table_field' => 'parenttable',
				'foreign_sortby' => 'perssort',
				'foreign_label' => 'uid_pers',
				'foreign_selector' => 'uid_pers',
				'foreign_unique' => 'uid_pers',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
					'useCombination' => 1,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),
		'literature_uids' => Array (
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.literature_uids',
			'config' => Array (
				'type' => 'inline',
				'foreign_table' => 'tx_hisodat_mm_lit',
				'foreign_field' => 'uid_local',
				'foreign_table_field' => 'parenttable',
				'foreign_sortby' => 'litsort',
				'foreign_label' => 'uid_foreign',
				#'foreign_selector' => 'uid_foreign', # BUG: if a relation with useCombination to an alread existing record is created, the combination table stays empty
				#'foreign_unique' => 'uid_foreign',
				// therefore a small configuration hack is employed - the select of the intermediate table get's a wizard_add that only appears if the record was saved;
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 50,
				'appearance' => Array (
					'collapseAll' => 1,
					'expandSingle' =>1,
					#'useCombination' => 1,
					'newRecordLinkPosition' => 'bottom',
				),
			)
		),
		'sources_uids' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.sources_uids',
			'config' => Array (
				'type' => 'group',
				'internal_type' => 'db',
					'allowed' => 'tx_hisodat_sources',
					'MM' => 'tx_hisodat_mm_src_src',
				'size' => '3',
				'autoSizeMax' => 10,
				'maxitems' => '200',
				'minitems' => '0',
				'show_thumbs' => '1'
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
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.div1,hidden,signature,signature_add,archive_uid,date_comment,date_start,date_end,short,sourcetext,description,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.div2,keywords_uids,literature_uids,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.div3,persons_uids,localities_uids,entities_uids,sources_uids,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.div4,image,imagecaption,
				--div--;LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_sources.div5,editor_id,editor_comment
				')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);

/*
$TCA['tx_hisodat_relations'] = Array (
	'ctrl' => $TCA['tx_hisodat_relations']['ctrl'],
	'interface' => Array (
		'showRecordFieldList' => 'hidden,title,relationtype,parent_relation,description'
	),
	'feInterface' => $TCA['tx_hisodat_persrelations']['feInterface'],
	'columns' => Array (
		'hidden' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
		'parent_relation' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_relations.parent_relation',
			'config' => Array (
				'type' => 'select',
				'form_type' => 'user',
				'userFunc' => 'tx_hisodat_treeview->displayCategoryTree',
				'treeView' => 1,
				'size' => 1,
				'autoSizeMax' => 10,
				'minitems' => 0,
				'maxitems' => 2,
				'foreign_table' => 'tx_hisodat_relations',
				'foreign_table_where' => 'AND tx_hisodat_relations.pid IN (###PAGE_TSCONFIG_IDLIST###)',
			)
		),
		'relationtype' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_relations.relationtype',
			'config' => Array (
				'type' => 'select',
				'items' => Array (
					Array('LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_relations.relationtype.I.0', '1'),
					Array('LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_relations.relationtype.I.1', '2'),
					Array('LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_relations.relationtype.I.2', '3'),
					Array('LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_relations.relationtype.I.3', '4'),
					Array('LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_relations.relationtype.I.4', '5'),
					Array('LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_relations.relationtype.I.5', '6'),
				),
				'default' => '1',
			)
		),
		'title' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_relations.title',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'max' => '255',
				'eval' => 'required,trim',
			)
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:hisodat/lang/locallang_db.php:tx_hisodat_relations.description',
			'config' => Array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
	),
	'types' => Array (
		'0' => Array('showitem' => 'hidden,title,relationtype,parent_relation,description')
	),
	'palettes' => Array (
		'1' => Array('showitem' => '')
	)
);
*/
?>