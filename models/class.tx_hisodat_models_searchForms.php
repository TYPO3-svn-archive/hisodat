<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Torsten Schrade <schradt@uni-mainz.de>
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
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * This model is concerned with anything related to HISODAT search forms
 *
 * @author Torsten Schrade <schradt@uni-mainz.de>
 * @package TYPO3
 * @subpackage hisodat
 */


class tx_hisodat_models_searchForms extends tx_lib_object {

	public function load() {
	}

	public function getDistinctPersons() {
	
		$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = TRUE;
		
		$res = '';
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('DISTINCT name','tx_hisodat_persons','hidden=0 AND deleted=0','','name','');
		
		$options = array();
		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_row($res)) {
			$options[] = $row[0];
		}
		
		$GLOBALS['TYPO3_DB']->sql_free_result($res);

		return $options;	
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/models/class.tx_hisodat_models_searchForms.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/models/class.tx_hisodat_models_searchForms.php']);
}
?>