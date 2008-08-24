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
 * Depends on:
 *
 * @author Torsten Schrade <schradt@uni-mainz.de>
 * @package TYPO3
 * @subpackage hisodat
 */


class tx_hisodat_models_resultBrowser extends tx_hisodat_models_sources {

	public function loadBrowser() {

		// instance of tslib_content
		tx_div::makeInstanceClassName('tx_lib_resultBrowser_model');
		$this->cObject = t3lib_div::makeInstance('tslib_cObj');

		// configuration parameters
		$currentKey = $this->getKeyFromList($this->controller->parameters->get('uid'));
		$currentRow = $this->getRowFromList($this->controller->parameters->get('uid'));
		$totalResultCount = $this->controller->configurations->get('totalResultCount');
		$limit = $this->controller->configurations->get('resultBrowser.resultsPerView');
		$offset = $this->controller->parameters->get('offset');
		$this->parameters = $this->controller->parameters->getHashArray();

		// get first and last uids of all paginations
		$this->_getPaginationUids();
		$paginationUids = $this->controller->configurations->get('paginationUids');

		// very first element
		if ($currentKey == 0 && $totalResultCount < $limit || $currentRow->get('uid') == $paginationUids['first']) {
			$prevLink = '';
			if ($totalResultCount > 1) $nextLink = $this->_rowPrevNext($currentKey+1, $offset);

		// very last element
		} elseif ($currentKey == $totalResultCount-1 && $totalResultCount < $limit || $currentRow->get('uid') == $paginationUids['last']) {
			$nextLink = '';
			if ($totalResultCount > 1) $prevLink = $this->_rowPrevNext($currentKey-1, $offset);

		// row before/after pagebreak
		} elseif ($currentRow->get('uid') == $paginationUids[$currentKey] && $totalResultCount > $limit) {

			if (($currentKey % $limit) == 0) {
				$prevLink = $this->_rowPrevNext($currentKey-1, $offset-$limit);
				// if ($offset == $currentRow)
				$nextLink = $this->_rowPrevNext($currentKey+1, $offset);
			} else {
				$prevLink = $this->_rowPrevNext($currentKey-1, $offset);
				// if ($offset == $currentRow+1)
				$nextLink = $this->_rowPrevNext($currentKey+1, $offset+$limit);
			}

		} else {
			$prevLink = $this->_rowPrevNext($currentKey-1, $offset);
			$nextLink = $this->_rowPrevNext($currentKey+1, $offset);
		}

		// set the data
		$this->set('linkToPrevious', $prevLink);
		$this->set('linkToNext', $nextLink);
		$this->set('backToList', $this->_backLink());
	}

	/**
	 * Gets the first and last uids of all paginations
	 *
	 * @return	array		All uids that are right before/after a pagebreak
	 */
	private function _getPaginationUids() {
		// collect the uids which are before/after a pagination within the result set
		$rowCounter = 0;
		$i = 0;
		foreach ($this->get('searchResultList') as $key => $row) {

#			if ($i == 0) $paginationUids[$rowCounter] = $row->get('uid');
			if ($i == 0) $paginationUids['first'] = $row->get('uid');
			if ($i == $this->controller->configurations->get('resultBrowser.resultsPerView')-1) $paginationUids[$rowCounter] = $row->get('uid');
			if ($i == $this->controller->configurations->get('resultBrowser.resultsPerView')) {
				$paginationUids[$rowCounter] = $row->get('uid');
				$i = 0;
			}
			// accumulate until we have the last row in the result
			$last = $row;
			$rowCounter++;
			$i++;
		}
		// put the last uid of the result into the pagination array
		$paginationUids['last'] = $last->get('uid');

		return $this->controller->configurations->set('paginationUids', $paginationUids);
	}


	/**
	 * Function for generating the link to the previous or next record in single view
	 *
	 * @param	int			The key of the current row for display
	 * @param	int			Points to the number in a prev/next result set
	 *
	 * @return	string		An array containing the two a-tag parts
	 */
	private function _rowPrevNext ($key, $offset) {

		$result = $this->get('searchResultList');
		$row = $result->get($key);

#		$parameters = $this->parameters;
		$parameters['action'] = 'showSource';
		$parameters['offset'] = (int) $offset;
		$parameters['uid'] = (int) $row->get('uid');
		$conf['additionalParams'] = tx_lib_resultBrowser_model::makeUrlParameters('&' . $this->controller->getDefaultDesignator(), $parameters);
		$conf['useCacheHash'] = $this->controller->configurations->get('resultbrowser.useCacheHash');
		$conf['parameter'] = $GLOBALS['TSFE']->id;
		$conf['returnLast'] = 'url';
		$url = $this->cObject->typolink(NULL, $conf);

		return htmlspecialchars($url);
	}

	private function _backLink () {

#		$this->parameters['action'] = 'quickSearch';
#		unset($this->parameters['caller']);
#		unset($this->parameters['uid']);

		$parameters['action'] = 'showResultList';
		$parameters['offset'] = (int) $this->controller->parameters->get('offset');;
		$conf['additionalParams'] = tx_lib_resultBrowser_model::makeUrlParameters('&' . $this->controller->getDefaultDesignator(), $parameters);
		$conf['useCacheHash'] = $this->controller->configurations->get('resultbrowser.useCacheHash');
		$conf['parameter'] = $this->controller->configurations->get('backToListPid');
		$conf['returnLast'] = 'url';
		$url = $this->cObject->typolink(NULL, $conf);

		return htmlspecialchars($url);

	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/resultbrowser/class.tx_hisodat_models_resultBrowser.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/hisodat/resultbrowser/class.tx_hisodat_models_resultBrowser.php']);
}
?>
