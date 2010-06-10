<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Torsten Schrade (schradt@uni-mainz.de)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * HOOK class for backend processing of TCEFORM
 *
 * @author	Torsten Schrade <schradt@uni-mainz.de>
 */



class tx_hisodat_t3lib_tceforms {

	function getSingleField_preProcess($table, $field, &$row, $altName, $palette, $extra, $pal, $pObj) {

		// extend the whitelist of TCA properties that can be overriden from PageTSConfig
		$pObj->allowOverrideMatrix['select'][] = 'wizards';
		$pObj->allowOverrideMatrix['select'][] = 'foreign_table';
		$pObj->allowOverrideMatrix['select'][] = 'foreign_table_where';

		// editor feature: only execute if the current field is 'editor' and if this field has no value yet
		if ($field == 'editor_id' && $table == 'tx_hisodat_sources' && !$row['editor']) {

			// get TSconfig-settings for the field
			$fieldTSconfig = $pObj->setTSconfig($table, $row, $field);

			// check if the current user is in the configured editor list and if yes preset the value
			if (t3lib_div::inList($GLOBALS['BE_USER']->user['usergroup'],$fieldTSconfig['PAGE_TSCONFIG_IDLIST'])) {
				$row[$field] = $GLOBALS['BE_USER']->user['uid'];
			}
		}
	}

/*
	function getSingleField_postProcess($table, $field, $row, $out, $PA, $this) {

	}
*/
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/configuration/class.tx_hisodat_t3lib_tceforms.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/configuration/class.tx_hisodat_t3lib_tceforms.php']);
}
?>