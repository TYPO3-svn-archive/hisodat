<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Torsten Schrade <schradt@uni-mainz.de>
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
 * This model is concerned with anything related to table tx_hisodat_sources
 *
 * @author Torsten Schrade <schradt@uni-mainz.de>
 * @package TYPO3
 * @subpackage hisodat
 */


class tx_hisodat_models_sources extends tx_lib_object {

	var $tableName = 'tx_hisodat_sources';

	// -------------------------------------------------------------------------------------
	// Public functions
	// -------------------------------------------------------------------------------------

	/* IMPORTANT: Always load the full result list, either from DB or from session but return only the part of the data determined by $offset.
	 * To have all elements at hand is needed for the singleview browser. Remember: the loadFromSession function of writes any existing data back into $this objects data array;
	 *
	 */
	public function load() {

		$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = TRUE;

		// find out which action is calling the model
		$action = $this->controller->parameters->get('action');

		// check if there is a former search result stored in the session
		$this->loadFromSession('searchResultList');

		// if the session returned search data the selection in relation to any given offset is returned
		if ($this->isNotEmpty() && $action != 'showSource') {

#			echo'LOAD FROM SESSION';

			$this->controller->configurations->set('totalResultCount', $this->count());
			return $this->set('searchResultList', $this->_returnSelection($this));
		}

		// else do a DB query
#		echo'DO A QUERY';

		switch ($action) {
			case 'quickSearch':
				$this->fullTextSearch();
			break;

			case 'standardSearch':
				$this->standardSearch();
			break;

			case 'expertSearch':
				$this->expertSearch();
			break;

			case 'showSource':
				if ($this->isNotEmpty()) {
					$this->controller->configurations->set('totalResultCount', $this->count());
					$list = new tx_lib_object(array());
					$list->loadFromSession('searchResultList');
					return $this->set('searchResultList', $list);
				}
			break;
		}
	}

	/* Description: resultUids will be filtered down by submitted parameters
	 * 
	 */
	public function standardSearch() {
		
		// general query settings
		$selectFields = $this->controller->configurations->get('selectFields');
		$orderBy = 'date_start';
		$where = 'hidden = 0 AND deleted = 0';
		$limit = null;
		$where .= ' AND tx_hisodat_sources.pid IN ('.$this->_getPidList().')';		

		// collect and work upon the incoming parameters
		
		// fulltext search first
		if ($this->controller->parameters->get('searchstring')) $this->fullTextSearch();		
				
		// related persons next
		if (is_array($this->controller->parameters->get('person_select'))) {
			// call the persons model statically and receive an array of uids of related sources for all persons in question; note: this means an OR combo since all uids are simply concatenated... 
			$relatedUids = implode(',', tx_hisodat_models_persons::getRelatedSources($this->controller->parameters->get('person_select')));			
			// if there was a result
			if (count($relatedUids) > 0) $this->_storeResultUids($relatedUids);
		}

		// dates last
		if ($this->controller->parameters->get('date_start') || $this->controller->parameters->get('date_end')) $this->dateSearch();
				
		// if we have no resultUids so far, do nothing
		if ($this->get('resultUids')) {
			
			// get filtered list of uids (resulting from fulltext / persons / date search) that qualify for the query;
			$where .= ' AND tx_hisodat_sources.uid IN ('.implode(',', $this->get('resultUids')).')';
			
			// perform the search query and generate the result list
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($selectFields, $this->tableName, $where, null, $orderBy, $limit);
			
#			debug($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery, 'standardSearch');
		
			if ($GLOBALS['TYPO3_DB']->sql_num_rows($res) > 0) {
				// store the result
				$this->_storeResultList($res);
				// free memory
				$GLOBALS['TYPO3_DB']->sql_free_result($res);
			}			
		}
	}
	
	/* Desciption
	 * 
	 */
	public function expertSearch() {
		die('Not yet implemented');
	}
	
	/**
	 * This method implements a search on a MySQL fulltext index in tx_hisodat sources based on the incoming searchstring.
	 * The following search rules have been implemented:
	 * 1) As default each searchword is combined with a boolean OR
	 * 2) If two words are combined with 'UND' they are joined with a '+' (boolean AND)
	 * 3) '*' wildcards at the end of words are possible
	 * 4) Quotation marks around the whole string will search for an exact match of the string
	 *
	 * @return	object		The results of the fulltext search
	 */
	public function fullTextSearch() {

		// query settings
		($this->controller->action == 'quickSearchAction') ? $selectFields = $this->controller->configurations->get('selectFields') : $selectFields = 'uid';	
		$matchFields = $this->controller->configurations->get('quickSearchResult.fullTextFields');
		$orderBy = 'mtch2 DESC';
		$where = 'hidden = 0 AND deleted = 0';
		$limit = null;
		// Pages with records
		$where .= ' AND tx_hisodat_sources.pid IN ('.$this->_getPidList().')';

		// transform the searchstring into the against string; first check for quotation marks according to the search rules
		$searchString = $this->controller->parameters->get('searchstring');
		if (substr($searchString, 0, 1) == '"' && substr($searchString, -1, 1) == '"') {
			$againstString = $GLOBALS['TYPO3_DB']->fullQuoteStr($searchString, 'tx_hisodat_sources');
		} else {
			// explode searchwords into an array
			$swords = preg_split('/[\s,;.+-<>()~"]+/', $searchString, -1, PREG_SPLIT_NO_EMPTY);
			// implement boolean AND modifiers
			$modSwords = array();
			foreach ($swords as $key => $value) {
				if ($value == 'UND') {
					if ($modSwords[$key-1]) $modSwords[$key-1] = '+'.$modSwords[$key-1];
					if ($swords[$key+1]) $modSwords[] = '+'.$swords[$key+1];
					continue;
				} else {
					if ($swords[$key-1] != 'UND') $modSwords[] = $value;
				}
			}
			// make sure that each searchword is unique
			$modSwords = array_unique($modSwords);
			// security: escape the search string
			$againstString = $GLOBALS['TYPO3_DB']->fullQuoteStr(implode(' ', $modSwords), 'tx_hisodat_sources');
		}

#		debug($againstString);

		$matchAgainst = ', MATCH('.$matchFields.') AGAINST('.$againstString.' IN BOOLEAN MODE) AS mtch1, ';
		$matchAgainst .= 'MATCH('.$matchFields.') AGAINST('.preg_replace('/[+*]+/', '',$againstString).') AS mtch2';
		$where .= ' HAVING mtch1 > 0';

		// perform the search query and generate the result list
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($selectFields.$matchAgainst, $this->tableName, $where, null, $orderBy, $limit);

#		debug($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery, 'fullTextSearch');
	
		if ($GLOBALS['TYPO3_DB']->sql_num_rows($res) > 0) {
			// for quickSearch, store the result immediately
			($this->controller->action == 'quickSearchAction') ? $this->_storeResultList($res) : $this->_storeResultUids($res);
			// free memory
			$GLOBALS['TYPO3_DB']->sql_free_result($res);	
		}
	}
	
	/*
	 * 
	 */
	public function dateSearch() {
		
		// query settings
		$res = '';
		$where = 'hidden = 0 AND deleted = 0';
		$where .= ' AND tx_hisodat_sources.pid IN ('.$this->_getPidList().')';		
		
		// collect parameters
		if ($this->controller->parameters->get('date_start')) $this->set('date_start', (int) $this->controller->parameters->get('date_start'));
		if ($this->controller->parameters->get('date_end')) $this->set('date_end', (int) $this->controller->parameters->get('date_end'));
		if ($this->controller->parameters->get('exclude_fuzzy_dates')) $this->set('exclude_fuzzy_dates', 1);
		
		// both parameters given
		if ($this->get('date_start') && $this->get('date_end')) {
				
			if (!$this->get('exclude_fuzzy_dates')) {
				// startdate within the given period
				$where .= ' AND ((SUBSTR(tx_hisodat_sources.date_start,-4) >= '.$this->get('date_start').' AND SUBSTR(tx_hisodat_sources.date_start,-4) <= '.$this->get('date_end').')';
				// enddate within given period
				$where .= ' OR (SUBSTR(tx_hisodat_sources.date_end,-4) <= '.$this->get('date_end').' AND SUBSTR(tx_hisodat_sources.date_end,-4) >= '.$this->get('date_start').')';
				// both dates within the given period
                $where .= ' OR (SUBSTR(tx_hisodat_sources.date_start,-4) < '.$this->get('date_start').' AND SUBSTR(tx_hisodat_sources.date_end,-4) > '.$this->get('date_end').'))';
			} else {
				// exact match within given period
				$where .= ' AND ((SUBSTR(tx_hisodat_sources.date_start,-4) >= '.$this->get('date_start').' AND SUBSTR(tx_hisodat_sources.date_end,-4) <= '.$this->get('date_end').'))';
			}
			
		// only start date given
		} elseif ($this->get('date_start') && !$this->get('date_end')) {				
			$where .= ' AND (SUBSTR(tx_hisodat_sources.date_start,-4) >= '.$this->get('date_start');
			(!$this->get('exclude_fuzzy_dates')) ? $where .= ' OR (SUBSTR(tx_hisodat_sources.date_end,-4) >= '.$this->get('date_start').'))' : $where .= ')';
				
		// only end date given
		} elseif ($this->get('date_end') && !$this->get('date_start')) {
			$where .= ' AND (SUBSTR(tx_hisodat_sources.date_end,-4) <= '.$this->get('date_end');
			(!$this->get('exclude_fuzzy_dates')) ? $where .= ' OR (SUBSTR(tx_hisodat_sources.date_start,-4) <= '.$this->get('date_end').'))' : $where .= ')';	
		}

		// execute query
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid', $this->tableName, $where, null, null, null);

#		debug($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery, 'dateSearch');		
		
		if ($GLOBALS['TYPO3_DB']->sql_num_rows($res) > 0) {
			// store result
			$this->_storeResultUids($res);
			// free memory
			$GLOBALS['TYPO3_DB']->sql_free_result($res);			
		}
	}

	/* Fetches all fields of a single record from tx_hisodat_sources from DB
	 *
	 * @return	object	The result of the DB query
	 */
	public function getByUid($uid) {
		
		// query settings
		$where = 'hidden = 0 AND deleted = 0';
		$where .= ' AND tx_hisodat_sources.pid IN ('.$this->_getPidList().')';
		$where .= ' AND uid=' . (int) $uid;
		
		// execute query
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $this->tableName, $where, null, null, null);
		
		if ($res) {		
			$row = $this->_makeRow($res);
			// free memory
			$GLOBALS['TYPO3_DB']->sql_free_result($res);
			return $row;
		}
	}

	/*
	 * 
	 */
	public function getRowFromList($uid) {
		if ($list = $this->get('searchResultList')) {
			foreach ($list as $key => $value) {
				if ($value->get('uid') == $uid) return $value;
			}
		} else return FALSE;
	}

	/*
	 * 
	 */
	public function getKeyFromList($uid) {
		if ($list = $this->get('searchResultList')) {
			foreach ($list as $key => $value) {
				if ($value->get('uid') == $uid) return $key;
			}
		} else return -1;
	}

	/*
	 * 
	 */
	public function getOldestYoungestDate($fieldname) {
		($fieldname == 'date_start') ? $orderBy = 'date_start ASC' : $orderBy = 'date_end DESC';
		$res = '';
		$date = '';
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($fieldname, 'tx_hisodat_sources', 'deleted=0 AND hidden=0 AND date_start != \'\' AND date_end != \'\'', null, $orderBy, 1);
		if ($res) {
			$date = $GLOBALS['TYPO3_DB']->sql_fetch_row($res);
			$date = substr($date[0], -4);
			// free memory
			$GLOBALS['TYPO3_DB']->sql_free_result($res);
			return $date;
		} else {
			return '0000';
		}
	}

	// -------------------------------------------------------------------------------------
	// Private functions
	// -------------------------------------------------------------------------------------

	/*
	 * 
	 */
	private function _storeResultList($result) {
		$resultList = new tx_lib_object(array());
		// check if this is a query result or a list of objects
		if (is_resource($result)) {
			$i = 1;
			while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)) {
				$row['rowcount'] = $i;

				// calls the function that fetches given relations to the source record if this is set from selectFields in TS
				if ($row['archive_uid'] || $row['categories_uids']  || $row['keywords_uids']  || $row['localities_uids']  || $row['persons_uids'] || $row['entities_uids'] || $row['literature_uids'] || $row['sources_uids']) {
					$row = $this->_fetchRelations($row);
				}

				// transform the result list to a list of objects
				$resultList->append(new tx_lib_object($row));
				$i++;
			}
		} elseif (is_object($result)) {
			$i = 1;
			for ($result->rewind(); $result->valid(); $result->next()) {
				$row = $result->current();
				$row->set('rowcount', $i);
				$resultList->append(new tx_lib_object($row));
				$i++;
			}
		} else {
			die('Result given is neither a query result nor a list of objects!');
		}

		// TODO: work on the storage method to only save the offset in question
		
		// store the total result count to the controllers register
		$this->controller->configurations->set('totalResultCount', $resultList->count());

		// store the full result to session for later retrival
		$resultList->storeToSession('searchResultList');

		// write the full result also into $this (eg for standard search filtering)
		$this->set('fullResult', $resultList);

		// store only selection if the result count exceeds the offset limits
		$this->set('searchResultList', $this->_returnSelection($resultList));
	}

	/*
	 * 
	 */
	private function _storeResultUids($queryResult) {
		// check if executed after a query or incoming value list
		if (is_resource($queryResult)) {			
			// write all uids of the result to an array for later comparison
			while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($queryResult)) {
					$resultUids[] = $row['uid'];
			}
		} elseif (is_string($queryResult)) {
			$resultUids = t3lib_div::trimExplode(',', $queryResult, 1);
		}
		// compare the result to any uids that might already have been set from other queries
		if ($this->get('resultUids')) {
				
			// AND combo will store only the equal values 
			$resultUids = array_intersect($this->get('resultUids'), $resultUids);			
				
			// OR combo will fuse all values into one unique array
			// $resultUids = array_unique($this->get('resultUids')+$resultUids);					
		}

#		debug($resultUids, '$resultUids');
				
		// store new values
		$this->set('resultUids', $resultUids);
	}

	/*
	 * 
	 */
	private function _returnSelection($resultList) {
		$offset = (int) $this->controller->parameters->get('offset');
		$listLimit = (int) $this->controller->configurations->get('resultBrowser.resultsPerView');
		($offset > 0) ? $offset = ($offset*0.1) * $listLimit : $offset = 0;
		$selection = new tx_lib_object(array());
		$i = 0;
		for ($resultList->rewind(); $resultList->valid(); $resultList->next()) {
			if ($resultList->key() >= $offset && $i < $listLimit) {
				$selection->append(new tx_lib_object($resultList->current()));
				$i++;
			}
		}
		return $selection;
	}

	/*
	 * 
	 */
	private function _makeRow($result) {
		if ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)) {
			// calls the function that fetches given relations to the source record if this is set from selectFields in TS
			if ($row['archive_uid'] || $row['categories_uids']  || $row['keywords_uids']  || $row['localities_uids']  || $row['persons_uids'] || $row['entities_uids'] || $row['literature_uids'] || $row['sources_uids']) {
				$row = $this->_fetchRelations($row);
			}
			return new tx_lib_object($row);
		}
	}

	/**
	 * Function from tslib_pibase for (recursively) collecting page ids from the tree that have been set by the user
	 *
	 * @return	string		comma list of page ids
	 */
	private function _getPidList() {
		$pid_list = $this->controller->configurations->get('storageFolder');
		$recursive = $this->controller->configurations->get('recursive');
		if (!strcmp($pid_list,'')) $pid_list = $GLOBALS['TSFE']->id;
		$recursive = t3lib_div::intInRange($recursive,0);
		$pid_list_arr = array_unique(t3lib_div::trimExplode(',', $pid_list, 1));
		$pid_list = array();
		foreach($pid_list_arr as $val)	{
			$val = t3lib_div::intInRange($val,0);
			if ($val)	{
				$_list = tslib_cObj::getTreeList(-1*$val, $recursive);
				if ($_list)	$pid_list[] = $_list;
			}
		}
		return implode(',', $pid_list);
	}

	/**
	 * Takes a result row array, fetches its relations and passes back the $row with with its relations
	 *
	 * @param	array		the $row from the query result
	 * @return	array		the $row with relations
	 */
	private function _fetchRelations($row) {

		// archive_uid
		if ($row['archive_uid'] > 0) {
			$res = '';
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('title','tx_hisodat_archives','uid='.$row['archive_uid'].'','','','');
			$relation = $GLOBALS['TYPO3_DB']->sql_fetch_row($res);
			$row['archive'] = $relation[0];
			// free memory
			$GLOBALS['TYPO3_DB']->sql_free_result($res);
		}
		
		if ($row['persons_uids'] > 0) {
			$row['persons'] = tx_hisodat_models_persons::getRelatedPersons($row['uid'], $this->tableName, 'tx_hisodat_mm_src_pers');
		}
		
		#debug($row);

		/*
		 * ... here follow other relations
		 */
		return $row;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/models/class.tx_hisodat_models_sources.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/models/class.tx_hisodat_models_sources.php']);
}
?>