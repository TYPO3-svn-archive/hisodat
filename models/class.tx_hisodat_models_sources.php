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
		$selectFields = $this->controller->configurations->get('selectFields');
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
		$queryResult = $GLOBALS['TYPO3_DB']->exec_SELECTquery($selectFields.$matchAgainst, $this->tableName, $where, null, $orderBy, $limit);
#		debug($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);

		// store the result
		if ($queryResult) $this->_storeResultList($queryResult);
	}

	/* If the fulltext field is used, first do a fulltext search. Next filter out the relevant hits according to the other parameters
	 * and then merge the results: conceptionally this means that all fieldsets are combined with AND. If only the other fields are used, do
	 * a query with these fields.
	 */
	public function standardSearch() {

		 // collect all possible search parameters for standard search besides the fulltext searchstring
		 // REMEMBER: must not be named $this->parameters since that is used in lib/div resutlBrowser
		$this->searchParameters = array();
		if ($this->controller->parameters->get('date_start')) $this->searchParameters['date_start'] = (int) $this->controller->parameters->get('date_start');
		if ($this->controller->parameters->get('date_end')) $this->searchParameters['date_end'] = (int) $this->controller->parameters->get('date_end');

		// if there is a fulltext search string do this first
		if ($this->controller->parameters->get('searchstring')) $this->fullTextSearch();

		// if there was a result from fulltext and there are more parameters, filter the result
		if ($this->get('searchResultList') && $this->searchParameters) {

			// hand over to the filter method
			$filteredResult = $this->_filterResultList($this->get('fullResult'));
			$this->_storeResultList($filteredResult);

		// if there are just parameters do a DB query based on them
		} elseif ($this->searchParameters) {

			$selectFields = $this->controller->configurations->get('selectFields');
			$orderBy = 'signature';
			$where = 'hidden = 0 AND deleted = 0';
			$limit = null;
			$where .= ' AND tx_hisodat_sources.pid IN ('.$this->_getPidList().')';

			if ($this->searchParameters['date_start'] && $this->searchParameters['date_end']) {

				// startdate within the given period
                $where .= ' AND (SUBSTR(tx_hisodat_sources.date_start,-4) >= '.$this->searchParameters['date_start'].' AND SUBSTR(tx_hisodat_sources.date_start,-4) <= '.$this->searchParameters['date_end'].')';
                // enddate within given period
                $where .= ' OR (SUBSTR(tx_hisodat_sources.date_end,-4) <= '.$this->searchParameters['date_end'].' AND SUBSTR(tx_hisodat_sources.date_end,-4) >= '.$this->searchParameters['date_start'].')';
                // record is valid for the whole period given in parameters
                $where .= ' OR (SUBSTR(tx_hisodat_sources.date_start,-4) < '.$this->searchParameters['date_start'].' AND SUBSTR(tx_hisodat_sources.date_end,-4) > '.$this->searchParameters['date_end'].')';

			} elseif ($this->searchParameters['date_start'] && !$this->searchParameters['date_end']) {
				$where .= ' AND SUBSTR(tx_hisodat_sources.date_start,-4) >= '.$this->searchParameters['date_start'].'';
			} elseif ($this->searchParameters['date_end'] && !$this->searchParameters['date_start']) {
				$where .= ' AND SUBSTR(tx_hisodat_sources.date_end,-4) <= '.$this->searchParameters['date_end'].'';
			}

			// perform the search query and generate the result list
			$queryResult = $GLOBALS['TYPO3_DB']->exec_SELECTquery($selectFields, $this->tableName, $where, null, $orderBy, $limit);
#			debug($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);

			// store the result
			if ($queryResult) $this->_storeResultList($queryResult);

		} // else: nothing must be stored since if there was a fulltext result it is already stored and if not there was no result at all
	}

	public function expertSearch() {
		die('Not yet implemented');
	}

	/* Fetches all fields of a single record from tx_hisodat_sources from DB
	 *
	 * @return	object	The result of the DB query
	 */
	public function getByUid($uid) {
		$where = 'hidden = 0 AND deleted = 0';
		// Pages with records
		$where .= ' AND tx_hisodat_sources.pid IN ('.$this->_getPidList().')';
		$where .= ' AND uid=' . (int) $uid;
		$queryResult = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $this->tableName, $where, null, null, null);
#		debug($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);
		if ($queryResult) {
			return $row = $this->_makeRow($queryResult);
		}
	}

	public function getRowFromList($uid) {
		if ($list = $this->get('searchResultList')) {
			foreach ($list as $key => $value) {
				if ($value->get('uid') == $uid) return $value;
			}
		} else return FALSE;
	}

	public function getKeyFromList($uid) {
		if ($list = $this->get('searchResultList')) {
			foreach ($list as $key => $value) {
				if ($value->get('uid') == $uid) return $key;
			}
		} else return -1;
	}

	// -------------------------------------------------------------------------------------
	// Private functions
	// -------------------------------------------------------------------------------------

	private function _filterResultList($resultToFilter) {

		$filteredResultlist = new tx_lib_object(array());

		for ($resultToFilter->rewind(); $resultToFilter->valid(); $resultToFilter->next()) {

			// set the current row and afterwards use the filters
			$row = $resultToFilter->current();

			// date check
			if ($this->searchParameters['date_start'] || $this->searchParameters['date_end']) {

				$startdate = (int) substr($row->get('date_start'),-4);
				$enddate =  (int) substr($row->get('date_end'),-4);

				if (($startdate >= $this->searchParameters['date_start'] && $startdate <= $this->searchParameters['date_end']) // startdate within period
					||
				($enddate <= $this->searchParameters['date_end'] && $enddate >= $this->searchParameters['date_start']) // enddate within period
					||
				($startdate < $this->searchParameters['date_start'] && $enddate > $this->searchParameters['date_end'])  // record valid for the whole period
					||
				($startdate >= $this->searchParameters['date_start'] && !$this->searchParameters['date_end']) // startdate in period but no end date given
					||
				($enddate <= $this->searchParameters['date_end'] && !$this->searchParameters['date_start'])) { // endate in period but no start date given
					// append to the filteres list
					$filteredResultlist->append(new tx_lib_object($row));
				}
			}
		}
		return $filteredResultlist;
	}

	private function _storeResultList ($result) {
		$resultList = new tx_lib_object(array());
		// check if this is a query result or a list of objects
		if (is_resource($result)) {
			$i = 1;
			while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)) {
				$row['rowcount'] = $i;
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

		// store the total result count to the controllers register
		$this->controller->configurations->set('totalResultCount', $resultList->count());

		// store the full result to session for later retrival
		$resultList->storeToSession('searchResultList');

		// write the full result also into $this (eg for standard search filtering)
		$this->set('fullResult', $resultList);

		// store only selection if the result count exceeds the offset limits
		$this->set('searchResultList', $this->_returnSelection($resultList));
	}

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

	private function _makeRow($result) {
		if ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)) {
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

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/models/class.tx_hisodat_models_sources.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/models/class.tx_hisodat_models_sources.php']);
}
?>
