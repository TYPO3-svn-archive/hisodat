<?php

########################################################################
# Extension Manager/Repository config file for ext: "hisodat"
#
# Auto generated 07-09-2008 21:00
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'HISODAT: Base',
	'description' => 'Historical Sources Online Database - Base application',
	'category' => 'plugin',
	'author' => 'Torsten Schrade',
	'author_email' => 'schradt@uni-mainz.de',
	'shy' => '',
	'dependencies' => 'lib,div,smarty',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => 'uploads/tx_hisodat/',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => 'Institute for Regional History and Culture, Mainz University',
	'version' => '0.0.17',
	'_md5_values_when_last_written' => 'a:69:{s:21:"ext_conf_template.txt";s:4:"eb21";s:12:"ext_icon.gif";s:4:"1bdc";s:17:"ext_localconf.php";s:4:"d3ef";s:14:"ext_tables.php";s:4:"15f8";s:14:"ext_tables.sql";s:4:"4278";s:12:"tca_main.php";s:4:"c8ec";s:10:"tca_mm.php";s:4:"7456";s:49:"configuration/class.tx_hisodat_t3lib_tceforms.php";s:4:"f1d2";s:48:"configuration/class.tx_hisodat_t3lib_tcemain.php";s:4:"1db6";s:42:"configuration/class.tx_hisodat_wizicon.php";s:4:"6350";s:27:"configuration/constants.txt";s:4:"8e67";s:26:"configuration/flexform.xml";s:4:"70ac";s:30:"configuration/pagetsconfig.txt";s:4:"de76";s:23:"configuration/setup.txt";s:4:"a7e5";s:56:"controllers/class.tx_hisodat_controllers_detailsView.php";s:4:"3498";s:56:"controllers/class.tx_hisodat_controllers_searchForms.php";s:4:"91d8";s:61:"controllers/class.tx_hisodat_controllers_searchResultList.php";s:4:"c476";s:17:"doc/CHANGELOG.txt";s:4:"66a9";s:14:"doc/README.txt";s:4:"a172";s:12:"doc/TODO.txt";s:4:"4fcd";s:18:"lang/locallang.php";s:4:"4f9c";s:31:"lang/locallang_csh_archives.xml";s:4:"d922";s:33:"lang/locallang_csh_categories.xml";s:4:"8c6d";s:31:"lang/locallang_csh_entities.xml";s:4:"bf9f";s:31:"lang/locallang_csh_keywords.xml";s:4:"f013";s:33:"lang/locallang_csh_literature.xml";s:4:"f53b";s:33:"lang/locallang_csh_localities.xml";s:4:"2c71";s:30:"lang/locallang_csh_persons.xml";s:4:"825e";s:32:"lang/locallang_csh_relations.xml";s:4:"d6ce";s:30:"lang/locallang_csh_sources.xml";s:4:"9609";s:35:"lang/locallang_csh_src_pers_loc.xml";s:4:"606e";s:21:"lang/locallang_db.xml";s:4:"26f0";s:26:"lang/locallang_extconf.xml";s:4:"bf23";s:27:"lang/locallang_flexform.xml";s:4:"65c8";s:42:"models/class.tx_hisodat_models_sources.php";s:4:"4456";s:14:"res/ce_wiz.gif";s:4:"02b6";s:32:"res/icon_tx_hisodat_archives.gif";s:4:"4220";s:35:"res/icon_tx_hisodat_archives__h.gif";s:4:"1323";s:34:"res/icon_tx_hisodat_categories.gif";s:4:"46e1";s:37:"res/icon_tx_hisodat_categories__h.gif";s:4:"4acc";s:32:"res/icon_tx_hisodat_entities.gif";s:4:"7e5e";s:35:"res/icon_tx_hisodat_entities__h.gif";s:4:"906a";s:32:"res/icon_tx_hisodat_keywords.gif";s:4:"a01b";s:35:"res/icon_tx_hisodat_keywords__h.gif";s:4:"ce0b";s:34:"res/icon_tx_hisodat_literature.gif";s:4:"e37e";s:37:"res/icon_tx_hisodat_literature__h.gif";s:4:"be8b";s:34:"res/icon_tx_hisodat_localities.gif";s:4:"dfe7";s:37:"res/icon_tx_hisodat_localities__h.gif";s:4:"c501";s:31:"res/icon_tx_hisodat_persons.gif";s:4:"955b";s:34:"res/icon_tx_hisodat_persons__h.gif";s:4:"3202";s:31:"res/icon_tx_hisodat_records.gif";s:4:"1b82";s:34:"res/icon_tx_hisodat_records__h.gif";s:4:"8e09";s:33:"res/icon_tx_hisodat_relations.gif";s:4:"22da";s:36:"res/icon_tx_hisodat_relations__h.gif";s:4:"c6a6";s:31:"res/icon_tx_hisodat_sources.gif";s:4:"940d";s:34:"res/icon_tx_hisodat_sources__h.gif";s:4:"5d76";s:60:"resultbrowser/class.tx_hisodat_controllers_resultBrowser.php";s:4:"52b6";s:55:"resultbrowser/class.tx_hisodat_models_resultBrowser.php";s:4:"58f9";s:54:"resultbrowser/class.tx_hisodat_views_resultBrowser.php";s:4:"83b8";s:39:"resultbrowser/resultBrowserTemplate.php";s:4:"1e2a";s:32:"templates/detailsViewSources.tpl";s:4:"becf";s:30:"templates/expertSearchForm.tpl";s:4:"e02d";s:29:"templates/quickSearchForm.tpl";s:4:"9c54";s:30:"templates/searchResultList.tpl";s:4:"8a85";s:32:"templates/standardSearchForm.tpl";s:4:"342a";s:39:"views/class.tx_hisodat_views_common.php";s:4:"e55f";s:44:"views/class.tx_hisodat_views_detailsView.php";s:4:"d022";s:44:"views/class.tx_hisodat_views_searchForms.php";s:4:"54d0";s:49:"views/class.tx_hisodat_views_searchResultList.php";s:4:"f567";}',
	'constraints' => array(
		'depends' => array(
			'lib' => '',
			'div' => '',
			'smarty' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
			'categories' => '',
		),
	),
	'suggests' => array(
	),
);

?>