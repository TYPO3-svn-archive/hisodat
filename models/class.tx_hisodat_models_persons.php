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
 * This model is concerned with anything related to HISODAT persons
 *
 * @author Torsten Schrade <schradt@uni-mainz.de>
 * @package TYPO3
 * @subpackage hisodat
 */


class tx_hisodat_models_persons extends tx_lib_object {
	
	var $tableName = 'tx_hisodat_persons';	

	public function load() {
	}
	
	/**
	 * Takes an array of persons names and returns an array of all related sources to the given persons
	 * @param	array		Array that holds the persons names
	 * @return	array		Array with the uids of related sources for each name
	 */
	public function getRelatedSources($persons=array()) {
				
		// initialize source array
		$relatedSources = array();
		
		if (count($persons) > 0) {
			
			// walk through the array and collect all related source uids
			foreach ($persons as $person) {
				
				// join query on the MM table
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'tx_hisodat_sources.uid',
					'tx_hisodat_persons,tx_hisodat_mm_src_pers,tx_hisodat_sources',
					'tx_hisodat_persons.name LIKE '.$GLOBALS['TYPO3_DB']->fullQuoteStr($person, 'tx_hisodat_persons').'
					AND tx_hisodat_sources.uid = tx_hisodat_mm_src_pers.uid_src
					AND tx_hisodat_persons.uid = tx_hisodat_mm_src_pers.uid_pers',
					'',
					'tx_hisodat_sources.uid',
					''
				);
				
				if ($GLOBALS['TYPO3_DB']->sql_num_rows($res) > 0) {				
					// write the related uids into a csv list				
					while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
						$relatedSources[$person] .= $row['uid'].',';
					}
					// trim last comma
					$relatedSources[$person] = substr($relatedSources[$person], 0, -1);
					// free memory			
					$GLOBALS['TYPO3_DB']->sql_free_result($res);
				} else {
					$relatedSources[$person] = '';
				}
			}
		}
		return $relatedSources;	
	}
	
	/* Description
	 * 
	 */
	public function getDistinctPersons() {
		
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

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/models/class.tx_hisodat_models_persons.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/models/class.tx_hisodat_models_persons.php']);
}
?>